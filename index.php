<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Календарь");
$APPLICATION->SetAdditionalCSS("/geo-ip/calendar/css/eventCalendar.css");
$APPLICATION->SetAdditionalCSS("/geo-ip/calendar/css/eventCalendar_theme_responsive.css");
$APPLICATION->AddHeadScript("/geo-ip/calendar/js/moment.js");
$APPLICATION->AddHeadScript("/geo-ip/calendar/js/jquery.eventCalendar.js");
$APPLICATION->AddHeadScript("/geo-ip/calendar/js/script.js");
?>
<?php
//Подключим модуль «Информационные блоки»
\Bitrix\Main\Loader::includeModule('iblock');

//Получить имя ORM класса для работы с инфоблоком
//echo \Bitrix\Iblock\Iblock::wakeUp(3)->getEntityDataClass(); //Где 3 - ID инфоблока «Новости»

$elements = \Bitrix\Iblock\Elements\ElementPropbNewsTable::getList([
    'select' => ['NAME', 'PREVIEW_TEXT'],
    'filter' => ['=ACTIVE' => 'Y'],
])->fetchAll();
function getJson($elements)
{

}

foreach ($elements as $element) {
    echo $element['ID'] . "<br>";
    echo "<b style='color:red;'>" . $element['NAME'] . "</b>" . "<br>";
    echo $element['PREVIEW_TEXT'] . "<br>";
}

?>
    <div id="eventCalendar" style="width: 300px; margin: 50px auto;"></div>
    <script>
        $(function () {
            var data = <?= $events;?>;
            $('#eventCalendar').eventCalendar({
                jsonData: data,
                // eventsjson: 'data.json',
                jsonDateFormat: 'human',
                startWeekOnMonday: true,
                openEventInNewWindow: true,
                dateFormat: 'dddd DD-MM-YYYY',
                showDescription: true,
                locales: {
                    locale: "ru",
                    txt_noEvents: "Нет запланированных событий",
                    txt_SpecificEvents_prev: "",
                    txt_SpecificEvents_after: "события:",
                    txt_NextEvents: "Следующие события:",
                    txt_GoToEventUrl: "Смотреть",
                    moment: {
                        "months": ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь",
                            "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"
                        ],
                        "monthsShort": ["Янв", "Фев", "Мар", "Апр", "Май", "Июн",
                            "Июл", "Авг", "Сен", "Окт", "Ноя", "Дек"
                        ],
                        "weekdays": ["Воскресенье", "Понедельник", "Вторник", "Среда", "Четверг",
                            "Пятница", "Суббота"
                        ],
                        "weekdaysShort": ["Вс", "Пн", "Вт", "Ср", "Чт",
                            "Пт", "Сб"
                        ],
                        "weekdaysMin": ["Вс", "Пн", "Вт", "Ср", "Чт",
                            "Пт", "Сб"
                        ]
                    }
                }
            });
        });
    </script>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>