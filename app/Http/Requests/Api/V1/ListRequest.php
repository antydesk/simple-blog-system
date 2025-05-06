<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class ListRequest extends FormRequest
{
    public const int PER_PAGE_DEFAULT = 25;

    public const string PER_PAGE = 'per_page';
    public const string PAGE = 'page';
    public const string Q = 'q';

    public function rules(): array
    {
        return [
            self::PER_PAGE => $this->getPerPageRule(),
            self::PAGE => [
                'integer',
                'nullable'
            ],
            self::Q => [
                'string',
                'nullable'
            ],
        ];
    }

    public function getPage(): int
    {
        return $this->get(self::PAGE) ?? 1;
    }

    public function getPerPage(): int
    {
        return $this->get(self::PER_PAGE) ?? self::PER_PAGE_DEFAULT;
    }

    public function getQ(): ?string
    {
        return $this->get(self::Q);
    }

    private function getPerPageRule(): string
    {
        return 'integer|max:100|min:1';
    }
}

