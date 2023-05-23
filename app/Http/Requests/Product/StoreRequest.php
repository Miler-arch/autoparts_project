<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:products', 
            'code' => 'nullable|string|max:8|min:8',
            'codigo' => 'required|max:30|unique:products',
            'price' => 'required|numeric',
            'picture' => 'required|image',
            'category_id' => 'required|integer|exists:categories,id',
            'provider_id' => 'required|integer|exists:providers,id',
            'marca_id' => 'required|integer|exists:marcas,id',
            'medida_id' => 'required|integer|exists:medidas,id',
        ];

    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es requerido',
            'name.unique' => 'El nombre ya existe',
            'codigo.required' => 'El código es requerido',
            'codigo.max' => 'Solo se permite 30 caracteres',
            'codigo.unique' => 'El código ya existe',
            'price.required' => 'El precio es requerido',
            'price.numeric' => 'Solo se permite números',
            'picture.required' => 'La imagen es requerida',
            'picture.image' => 'Solo se permite imagenes',
            'category_id.required' => 'La categoría es requerida',
            'category_id.integer' => 'La categoría es requerida',
            'category_id.exists' => 'La categoría es requerida',
            'provider_id.required' => 'El proveedor es requerido',
            'provider_id.integer' => 'El proveedor es requerido',
            'provider_id.exists' => 'El proveedor es requerido',
            'marca_id.required' => 'La marca es requerida',
            'marca_id.integer' => 'La marca es requerida',
            'marca_id.exists' => 'La marca es requerida',
            'medida_id.required' => 'La medida es requerida',
            'medida_id.integer' => 'La medida es requerida',
            'medida_id.exists' => 'La medida es requerida', 
        ];
    }
}
