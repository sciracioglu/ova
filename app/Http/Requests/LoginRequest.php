<?php namespace App\Http\Requests;


use Illuminate\Http\Request;

class LoginRequest extends Request {

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
			'kullanici' => 'required',
			'sifre'     => 'required|min:4',
			'gkod'      => 'required|min:3'
		];
	}

}
