<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

// use App\User;

class ProjectInvitationRequest extends FormRequest
{
    protected $errorBag = 'invitations';

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Actually we need here $project,
        // How do we get it in the formrequest?
        // We are using route model binding, which means: when I call $this->route('project')
        // it gonna give me the project, cause /project/{project}/invitation, {project} is a wildcard
        // when we try to result that, it gonna give me a underline project
        return Gate::allows('manage', $this->route('project'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'email' => ['required', 'exists:users,email']

            'email' => ['required', Rule::exists('users', 'email')],

            // 'email' => ['required', function($attribute, $value, $fail) {
            //     if (! User::whereEmail($value)->exists()) {
            //         $fail('The user you are inviting must have a Birdboard account.');
            //     }
            // }
            // ]
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.exists' => 'The user you are inviting must have a Birdboard account.',
        ];
    }
}
