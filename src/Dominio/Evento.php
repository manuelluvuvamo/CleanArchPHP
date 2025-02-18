<?php

namespace CleanCode\Arquitetura\Dominio;

interface Evento
{
    public function momento(): \DateTimeImmutable;
}