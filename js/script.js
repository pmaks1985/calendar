$(function () {
    $('#eventCalendar').eventCalendar({
        eventsjson: 'data.json',
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