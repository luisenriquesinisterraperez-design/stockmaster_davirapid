<?php
declare(strict_types=1);

namespace App\Controller;

class ProductIngredientsController extends AppController
{
    public function recipe($productId = null)
    {
        if (!$productId) {
            return $this->redirect(['controller' => 'Products', 'action' => 'index']);
        }
        
        $product = $this->fetchTable('Products')->get($productId, [
            'contain' => ['ProductIngredients' => ['Ingredients']]
        ]);

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $productIngredient = $this->ProductIngredients->newEmptyEntity();
            $productIngredient = $this->ProductIngredients->patchEntity($productIngredient, $data);
            $productIngredient->product_id = $productId;

            if ($this->ProductIngredients->save($productIngredient)) {
                // Si se proporcionó un costo, actualizar el insumo
                if (!empty($data['cost_update'])) {
                    $ingredientsTable = $this->fetchTable('Ingredients');
                    $ingredient = $ingredientsTable->get($data['ingredient_id']);
                    $ingredient->cost = (float)$data['cost_update'];
                    $ingredientsTable->save($ingredient);
                }
                
                $this->Flash->success(__('Ingrediente añadido a la receta y costo actualizado.'));
            } else {
                $this->Flash->error(__('No se pudo añadir el ingrediente.'));
            }
            return $this->redirect(['action' => 'recipe', $productId]);
        }

        $ingredients = $this->ProductIngredients->Ingredients->find('list', ['limit' => 200])->all();
        $this->set(compact('product', 'ingredients'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $productIngredient = $this->ProductIngredients->get($id);
        $productId = $productIngredient->product_id;
        
        if ($this->ProductIngredients->delete($productIngredient)) {
            $this->Flash->success(__('Ingrediente removido de la receta.'));
        }
        return $this->redirect(['action' => 'recipe', $productId]);
    }
}
