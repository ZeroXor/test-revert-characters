<?php

use PHPUnit\Framework\TestCase;

class RevertCharacterTest extends TestCase
{
    /**
     * Переворот слов в строке
     * @dataProvider providerRevertCharacters
     * @param string  $origString
     * @param string $revString
     */
    public function testRevertCharacters($origString, $revString): void
    {
        $model = new RevertCharacters();
        $this->assertEquals($revString, $model->revertCharacters($origString));
    }

    /**
     * Возврат строки к первоначальной (обратный переворот)
     * @dataProvider providerRevertCharacters
     * @param string $string
     */
    public function testDoubleRevertCharacters($string): void
    {
        $model = new RevertCharacters();
        $revertString = $model->revertCharacters($string);
        $this->assertEquals($string, $model->revertCharacters($revertString));
    }

    /**
     * @return string[][]
     */
    /* TODO: Я не поклонник творчества Лепса, просто интересный палиндром, как раз подходящий под задачу */
    public function providerRevertCharacters()
    {
        return [
            [
                'Привет! Как деЛа?',
                'Тевирп! Как алЕд?',
            ],
            [
                'Привет! Давно не виделись.',
                'Тевирп! Онвад ен ьсиледив.',
            ],
            [
                'Victory!',
                'Yrotciv!',
            ],
            [
                'Спел Лепс',
                'Лепс Спел',
            ]
        ];
    }
}
