<?php

declare(strict_types=1);

namespace Yii\Extension\Simple\Model\Tests\Stub;

use Yii\Extension\Simple\Model\BaseModel;
use Yiisoft\Validator\Rule\Email;
use Yiisoft\Validator\Rule\HasLength;
use Yiisoft\Validator\Rule\Required;

final class LoginModelStub extends BaseModel
{
    public string $name = '';
    private static ?string $extraField = null;
    private string $lastName = '';
    private ?string $login = null;
    private ?string $password = null;
    private bool $rememberMe = false;

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function getRememberMe(): bool
    {
        return $this->rememberMe;
    }

    public function login(string $value): void
    {
        $this->login = $value;
    }

    public function password(string $value): void
    {
        $this->password = $value;
    }

    public function rememberMe(bool $value): void
    {
        $this->rememberMe = $value;
    }

    public function getAttributeHints(): array
    {
        return [
            'login' => 'Write your id or email.',
            'password' => 'Write your password.',
        ];
    }

    public function getAttributeLabels(): array
    {
        return [
            'login' => 'Login:',
            'password' => 'Password:',
            'rememberMe' => 'remember Me:',
        ];
    }

    public function getFormName(): string
    {
        return 'LoginModel';
    }

    public function getRules(): array
    {
        return [
            'login' => $this->loginRules(),
            'password' => $this->passwordRules(),
        ];
    }

    private function loginRules(): array
    {
        return [
            Required::rule(),
            HasLength::rule()->min(4)->max(40)->tooShortMessage('Is too short.')->tooLongMessage('Is too long.'),
            Email::rule(),
        ];
    }

    private function passwordRules(): array
    {
        return [
            Required::rule(),
            HasLength::rule()->min(8)->tooShortMessage('Is too short.'),
        ];
    }
}
