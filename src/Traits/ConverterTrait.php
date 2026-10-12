<?php

namespace Naf\Sanity\Traits;

trait ConverterTrait
{
    public function toInt(): self
    {
        $this->item = (int) $this->item;

        return $this;
    }

    public function toFloat(): self
    {
        $this->item = (float) $this->item;

        return $this;
    }

    public function toBool(): self
    {
        $this->item = (bool) $this->item;

        return $this;
    }

    public function toArray(): self
    {
        $this->item = (array) $this->item;

        return $this;
    }

    public function getValue()
    {
        return $this->item;
    }
}
