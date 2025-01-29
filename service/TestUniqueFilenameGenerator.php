<?php

namespace App\Service;

use PHPUnit\Framework\TestCase;

class TestUniqueFilenameGenerator extends TestCase
{
    public function testGenerate()
    {
        $generator = new UniqueFilenameGenerator();

        // Tester la génération du nom unique
        $filename = $generator->generate('jpg');

        // Vérifier que le nom de fichier généré commence par un identifiant unique et se termine par l'extension 'jpg'
        $this->assertMatchesRegularExpression('/^\w+\.jpg$/', $filename);
    }
}
