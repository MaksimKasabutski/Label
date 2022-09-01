<?php

namespace Krexik\Label\Api\Label;

interface GetLabelImageUrlInterface
{
    public function execute(?string $imageName): ?string;
}
