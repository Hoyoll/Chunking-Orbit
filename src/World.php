<?php
namespace Hoyoll\ChunkingOrbit;

use FFI;

interface Entity {
    public function update();
}

class World {
    private array $entities;
    
    private FFI $rl;

    public function put_entities(Entity $entity)
    {
        array_push($this->entities, $entity);
    }

    public function run()
    {
        
    }
    
    public function __construct()
    {
        $this->entities = [];
        $this->rl = FFI::cdef(file_get_contents(__DIR__."/../clib/raylib.h"), "raylib.dll");
    }

}
