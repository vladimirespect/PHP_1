<?php


namespace app\interfaces;


interface IRenderer
{
    public function renderTemplate($template, $params = []);
}

/* Этот интерфейс создан для реализации второго принципа солид
Классы должны быть открыты для расширения, но закрыты для изменения.
Так мы хотели научить Контроллеры рендерить разными способами,
поэтому пришлось вынести рендер во внешнюю среду,
создать дополнительный класс рендерТвиг и создать для них интерфейс,
да ещё явно задать в контроллере что ожидается рендер с интерфейса IRenderer
но теперь контроллер может рендерить разными способами, при том что типо в нем ничего не изменили*/

