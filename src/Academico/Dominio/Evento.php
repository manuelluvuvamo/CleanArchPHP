<?php

namespace CleanCode\Arquitetura\Academico\Dominio;

interface Evento
{
    public function momento(): \DateTimeImmutable;
}