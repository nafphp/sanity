<?php

namespace Naf\Sanity\Traits;

use DateException;
use DateTime;
use DateTimeImmutable;
use DateTimeZone;
use Exception;

trait ValidatorTrait
{
    public function isArray(): bool
    {
        return is_array($this->item);
    }

    public function isString(): bool
    {
        return is_string($this->item);
    }

    public function isInt(): bool
    {
        return is_int($this->item);
    }

    public function isFloat(): bool
    {
        return is_float($this->item);
    }

    public function isBool(): bool
    {
        return is_bool($this->item);
    }

    public function isObject(): bool
    {
        return is_object($this->item);
    }

    public function isNull(): bool
    {
        return is_null($this->item);
    }

    public function isCallable(): bool
    {
        return is_callable($this->item);
    }

    public function isEmpty(): bool
    {
        if ($this->isInt()) {
            return false;
        }

        if ($this->isBool()) {
            return false;
        }

        return empty($this->item);
    }

    public function isNotEmpty(): bool
    {
        return !$this->isEmpty();
    }

    public function isEmail(): bool
    {
        return filter_var($this->item, FILTER_VALIDATE_EMAIL);
    }

    public function isUrl(): bool
    {
        return filter_var($this->item, FILTER_VALIDATE_URL);
    }

    public function isDate(?string $format = null): bool
    {
        try {

            $result  = [];
            $pattern = '/\b\d{1,4}([.\/-]\d{1,2}){1,2}\.?\b/';

            $regex = preg_match($pattern, $this->item, $result);

            $isDate = function ($value, $format) {
                $dt = new DateTime($value, new DateTimeZone('Europe/Berlin'));

                return $dt->format($format) === $value;
            };

            $formats = [
                'd.m.Y',
                'd.n.Y',
                'd.m.',
                'd.n.',
                'Y.m.d',
                'Y-m-d',
                'm-d',
                'd/m/Y',
                'Y/m/d',
            ];

            foreach ($formats as $format) {
                if ($isDate($this->item, $format) || count($result)) {
                    return true;
                }
            }

        } catch (DateException $e) {
        }

        return false;
    }

    public function isDateTime(): bool
    {
        try {

            $result  = [];
            $pattern = '/\b\d{1,4}([.\/-]\d{1,2}){1,2}\.?\s\d{1,2}:\d{2}(:\d{2})?\b/';

            $regex = preg_match($pattern, $this->item, $result);

            return (bool) count($result);


        } catch (DateException $e) {
        }

        return false;
    }

    public function isTime(): bool
    {
        try {
            new DateTimeImmutable($this->item);
        } catch (Exception $e) {
            return false;
        }

        return true;
    }

    public function isNumber(): bool
    {
        return is_numeric($this->item);
    }
}
