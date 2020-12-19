<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use GuzzleHttp\Client;

class Recaptcha implements Rule
{
    private $_base_score;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($base_score = 0.5)
    {
        $this->_base_score = $base_score;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $client = new Client();
        $response = $client->request('POST', 'https://www.google.com/recaptcha/api/siteverify', [
            'form_params' => [
                'secret' => env('RECAPTCHA_SECRET_KEY'),
                'response' => $value
            ]
        ]);
        $results = json_decode($response->getBody(), true);
        return (
            $results['success'] &&
            $results['score'] > $this->_base_score
        );
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '機械的なアクセスだと判定されました。リロードしてもう一度実行してください。';
    }
}
