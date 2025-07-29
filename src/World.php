<?php
namespace Hoyoll\ChunkingOrbit;

use FFI;

abstract class Entity {    
    public abstract function update(FFI $ffi, string $message): string;
}

class World {
    /** @var Entity[] */
    private array $entities;    

    private FFI $rl;

    public function put_entities(Entity... $entities)
    {
        array_push($this->entities, ...$entities);
    }

    public function run()
    {
        while (!$this->rl->WindowShouldClose()) {
            $this->rl->BeginDrawing();
            $this->rl->ClearBackground(0x000000FF);
            foreach ($this->entities as $entity) {
                $msg = $entity->update($this->rl, "RUN");
                if ($msg === "STOP") {
                    break;
                }
            }
            $this->rl->EndDrawing();
        }
    }
    
    public function __construct(FFI $ffi)
    {
        $this->entities = [];
        $this->rl = $ffi;
    }

}
