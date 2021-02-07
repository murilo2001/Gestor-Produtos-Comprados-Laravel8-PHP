<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdutoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //trocar para false pois apenas usuarios logados podem fazer isso
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
            'nome' => 'bail|required|min:2|max:120',
            'categoria_id' => 'bail|required',
            'valor' => 'bail|required|numeric',
            'data_compra' => 'bail|required|date',
            'tempo_garantia_meses' => 'bail|required|integer',
            'nota_fiscal_image' => 'bail|image|max:2048', /* Verifica se o arquivo que foi feito upload é uma imagem e se tem o tamanho até 2MB = 2048KB */
            'observacao' => 'bail|nullable|string|min:3|max:255' /* nullable = quando não vir valor recebe null */
        ];
    }
    
    /**
     * Costomizar o nome dos campos para as mensagens de erro
     */
    public function attributes()
    {
        return [
            'nome' => 'produto',
            'categoria_id' => 'categoria',
            'nota_fiscal_image' => 'nota fiscal imagem',
            'data_compra' => 'data de compra'
        ];
    }
}
