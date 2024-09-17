<?php

namespace Entryshop\Shop\Contracts;

interface Purchasable
{
    public function getKey();

    public function getMorphClass();

    public function getPrice();

    public function getName();

    public function getSku();

    public function getImage();

}
