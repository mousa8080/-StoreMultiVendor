<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use App\Models\Category;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if($this->route('category')){
            //update
            return Gate::allows('category.update');
        }
        //create    
        return  Gate::allows('category.update');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = $this->route('category');
        return Category::rules($id);
    }
    public function messages(){
        return [
            'name.required'=>'(:attribute) لازم تدخل الاسم يسطا',
            'name.unique'=>'(:attribute)  name is uniqe mousa',
            'name.min'=>'(:attribute)  name is uniqe mousa',
            'name.max'=>'(:attribute)  name is uniqe mousa',
            'parent_id.exists'=>'(:attribute)  name is uniqe mousa',
            'image.image'=>'(:attribute)  name is uniqe mousa',
            'image.max'=>'(:attribute)  name is uniqe mousa',
            'status.in'=>'(:attribute)  name is uniqe mousa',
        ];
    }
}
