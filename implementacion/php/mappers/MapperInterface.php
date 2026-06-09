<?php
interface MapperInterface
{
    public function findById(int $id): ?object;
    public function findAll(): array;
    public function insert(object $obj): bool;
    public function update(object $obj): bool;
    public function delete(int $id): bool;
}
?>