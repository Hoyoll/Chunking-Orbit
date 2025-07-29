<?php
require __DIR__.'/../vendor/autoload.php';

use Hoyoll\ChunkingOrbit\Entity;
use Hoyoll\ChunkingOrbit\World;

$rl = FFI::cdef(file_get_contents(__DIR__."/../clib/raylib.h"), __DIR__."/../clib/raylib.dll");

$rl->SetTargetFPS(60);
$rl->InitWindow(800, 600, "Chunking Express!");
$world = new World($rl);

class Sheet extends Entity {
    /** @var array<string, FFI\CData> */
    private array $textures = [];
    private int $offset_y = 0;
    private int $offset_x = 0;
    private string $space = __DIR__.'/assets/pic/starfield.png';
    public function update(FFI $ffi, string $message): string
    {
        return match ($message) {
            "RUN" => $this->run($ffi)
        };
    }

    public function run(FFI $ffi): string
    {
        $this->load_image($ffi, $this->space);
        if ($ffi->IsKeyDown($ffi->KEY_W)) {
            $this->offset_y -= 1;
        }
        $ffi->DrawTexture($this->textures[$this->space], 0, $this->offset_y, 0xFFFFFFFF);
        return "RUN";
    }

    public function load_image(FFI $ffi, string $file)
    {
        $this->textures[$file] ??= $ffi->LoadTexture($file);
    }
}
$world->put_entities(...[new Sheet()]);
$world->run();
