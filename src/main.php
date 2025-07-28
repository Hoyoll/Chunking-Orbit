<?php
require __DIR__.'/../vendor/autoload.php';

use Hoyoll\ChunkingOrbit\World;

$c = new World();
$rl = FFI::cdef(file_get_contents(__DIR__."/../clib/raylib.h"), __DIR__."/../clib/raylib.dll");

$rl->InitWindow(800, 600, "Hello Raylib!");
$rl->SetTargetFPS(60);
$rec = $rl->new("Rectangle");
$rec->x = 20;
$rec->y = 20;
$rec->width = 30;
$rec->height = 30;
while (!$rl->WindowShouldClose()) {
    $rl->BeginDrawing();
    $rl->ClearBackground(0x000000FF);
    $rl->DrawFPS(10, 10);
    $rl->DrawRectangleRec($rec, 0x43ca64d9);
   // $rl->DrawRec()
    $rl->DrawText("Hello, cursed world!", 190, 200, 20, 0xFFFFFFFF);
    $rl->EndDrawing();
}
$rl->CloseWindow();
