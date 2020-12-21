<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Календарь");
$APPLICATION->SetAdditionalCSS("/geo-ip/calendar/css/eventCalendar.css");
$APPLICATION->SetAdditionalCSS("/geo-ip/calendar/css/eventCalendar_theme_responsive.css");
$APPLICATION->AddHeadScript("/geo-ip/calendar/js/moment.js");
$APPLICATION->AddHeadScript("/geo-ip/calendar/js/jquery.eventCalendar.js");
?>
<?php
//Подключим модуль «Информационные блоки»
\Bitrix\Main\Loader::includeModule('iblock');

//Получить имя ORM класса для работы с инфоблоком
//echo \Bitrix\Iblock\Iblock::wakeUp(3)->getEntityDataClass(); //Где 3 - ID инфоблока «Новости»

$elements = \Bitrix\Iblock\Elements\ElementPropbNewsTable::getList([ //В $elements получаю выборку параметров, указанных в 'select'
    'select' => ['DATE_CREATE', 'NAME', 'PREVIEW_TEXT', 'CODE'],
    'filter' => ['=ACTIVE' => 'Y'],
])->fetchAll();
function getJson($elements) //Функция формирования JSON, для правильного формирования url, в файле jquery.eventCalendar.js, 420 строка, указал путь для раздела /news/
{
    $data = '[';
    foreach ($elements as $item) {
        $data .= '{ "date": "' . date_format(date_create($item['DATE_CREATE']), 'Y-m-d H:i:s') . '", "title": "' . str_replace("\"", "", preg_replace('/\s+/', ' ', strip_tags($item['NAME']))) . '", "description": "' . str_replace("\"", "", preg_replace('/\s+/', ' ', strip_tags($item['PREVIEW_TEXT']))) . '","url": "' . $item['CODE'] . "/" . '"},';
    }
    $data .= ']';
    return $data;
}

$events = getJson($elements);
?>
    <div id="eventCalendar" style="width: 300px; margin: 50px auto;"></div>
    <script>
        $(function () {
            var data = <?=$events;?>;
            $('#eventCalendar').eventCalendar({
                jsonData: data,
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