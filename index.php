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
    'select' => ['DATE_CREATE', 'NAME', 'PREVIEW_TEXT'],
    'filter' => ['=ACTIVE' => 'Y'],
])->fetchAll();
function getJson($elements)
{
    $data = '[';
    foreach ($elements as $item) {
        $data .= '{ "date": "' . $item['DATE_CREATE'] . '", "title": "' . $item['NAME'] . '", "description": "' . $item['PREVIEW_TEXT'] . '"}';
    }
    $data .= ']';
    return $data;
}

$events = getJson($elements);
//echo $events;
?>
    <div id="eventCalendar" style="width: 300px; margin: 50px auto;"></div>
    <script>
        $(function () {
            data = [
                { "date": "2015-09-21 10:15:20", "title": "Событие 1", "description": "Lorem Ipsum dolor set", "url": "http://www.event3.com/" },
                { "date": "2015-09-21 10:15:20", "title": "Событие 2", "description": "Lorem Ipsum dolor set", "url": "" },
                { "date": "2015-09-01 10:15:20", "title": "Событие 3", "description": "Lorem Ipsum dolor set", "url": "http://www.event3.com/" },
                { "date": "2015-10-21 10:15:20", "title": "Событие 4", "description": "Lorem Ipsum dolor set", "url": "http://www.event3.com/" },
            ];
            $('#eventCalendar').eventCalendar({
                jsonData: data,
                jsonDateFormat: 'human',
                startWeekOnMonday: true,
                openEventInNewWindow: true,
                dateFormat: 'dddd DD-MM-YYYY',
                showDescription: true,
                cacheJson: false,
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