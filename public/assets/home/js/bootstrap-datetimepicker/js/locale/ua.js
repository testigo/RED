// moment.js locale configuration
// locale : ukraine (ua)

(function (factory) {
    if (typeof define === 'function' && define.amd) {
        define(['moment'], factory); // AMD
    } else if (typeof exports === 'object') {
        module.exports = factory(require('../moment')); // Node
    } else {
        factory(window.moment); // Browser global
    }
}(function (moment) {
    function plural(word, num) {
        var forms = word.split('_');
        return num % 10 === 1 && num % 100 !== 11 ? forms[0] : (num % 10 >= 2 && num % 10 <= 4 && (num % 100 < 10 || num % 100 >= 20) ? forms[1] : forms[2]);
    }

    function relativeTimeWithPlural(number, withoutSuffix, key) {
        var format = {
            'mm': withoutSuffix ? 'хвилина_хвилини_хвилин' : 'хвилину_хвилини_хвилин',
            'hh': 'годину_години_годин',
            'dd': 'день_дня_днів',
            'MM': 'місяць_місяці_місяців',
            'yy': 'рік_року_років'
        };
        if (key === 'm') {
            return withoutSuffix ? 'хвилина' : 'хвилину';
        }
        else {
            return number + ' ' + plural(format[key], +number);
        }
    }

    function monthsCaseReplace(m, format) {
        var months = {
                'nominative': 'січень_лютий_березень_квітень_травень_червень_липень_серпень_вересень_жовтень_листопад_грудень'.split('_'),
                'accusative': 'січня_лютого_березня_квітня_травня_червеня_липня_серпня_вересеня_жовтня_листопада_грудня'.split('_')
            },

            nounCase = (/D[oD]?(\[[^\[\]]*\]|\s+)+MMMM?/).test(format) ?
                'accusative' :
                'nominative';

        return months[nounCase][m.month()];
    }

    function monthsShortCaseReplace(m, format) {
        var monthsShort = {
                'nominative': 'січ_лют_бер_квіт_трав_черв_лип_серп_вер_жовт_лист_груд'.split('_'),
                'accusative': 'січ_лют_бер_квіт_трав_черв_лип_серп_вер_жовт_лист_груд'.split('_')
            },

            nounCase = (/D[oD]?(\[[^\[\]]*\]|\s+)+MMMM?/).test(format) ?
                'accusative' :
                'nominative';

        return monthsShort[nounCase][m.month()];
    }

    function weekdaysCaseReplace(m, format) {
        var weekdays = {
                'nominative': 'неділя_понеділок_вівторок_середа_четверг_п\'ятниця_субота'.split('_'),
                'accusative': 'неділі_понеділка_вівторка_середи_четверга_п\'ятниці_суботи'.split('_')
            },

            nounCase = (/\[ ?[Вв] ?(?:попередню|наступну)? ?\] ?dddd/).test(format) ?
                'accusative' :
                'nominative';

        return weekdays[nounCase][m.day()];
    }

    return moment.defineLocale('ua', {
        months : monthsCaseReplace,
        monthsShort : monthsShortCaseReplace,
        weekdays : weekdaysCaseReplace,
        weekdaysShort : "нд_пн_вт_ср_чт_пт_сб".split("_"),
        weekdaysMin : "нд_пн_вт_ср_чт_пт_сб".split("_"),
        monthsParse : [/^січ/i, /^лют/i, /^бер/i, /^квіт/i, /^трав/i, /^черв/i, /^лип/i, /^серп/i, /^вер/i, /^жовт/i, /^лист/i, /^груд/i],
        longDateFormat : {
            LT : "HH:mm",
            L : "DD.MM.YYYY",
            LL : "D MMMM YYYY р.",
            LLL : "D MMMM YYYY р., LT",
            LLLL : "dddd, D MMMM YYYY р., LT"
        },
        calendar : {
            sameDay: '[Сьогодні о] LT',
            nextDay: '[Завтра о] LT',
            lastDay: '[Вчора о] LT',
            nextWeek: function () {
                return this.day() === 2 ? '[В] dddd [о] LT' : '[В] dddd [о] LT';
            },
            lastWeek: function () {
                switch (this.day()) {
                    case 0:
                        return '[В минуле] dddd [о] LT';
                    case 1:
                    case 2:
                    case 4:
                        return '[В минулий] dddd [о] LT';
                    case 3:
                    case 5:
                    case 6:
                        return '[В минулої] dddd [о] LT';
                }
            },
            sameElse: 'L'
        },
        relativeTime : {
            future : "через %s",
            past : "%s назад",
            s : "кілька секунд",
            m : relativeTimeWithPlural,
            mm : relativeTimeWithPlural,
            h : "нодина",
            hh : relativeTimeWithPlural,
            d : "день",
            dd : relativeTimeWithPlural,
            M : "місяць",
            MM : relativeTimeWithPlural,
            y : "рік",
            yy : relativeTimeWithPlural
        },

        meridiemParse: /ночі|ранку|дня|вечора/i,
        isPM : function (input) {
            return /^(дня|вечора)$/.test(input);
        },

        meridiem : function (hour, minute, isLower) {
            if (hour < 4) {
                return "ночі";
            } else if (hour < 12) {
                return "ранку";
            } else if (hour < 17) {
                return "дня";
            } else {
                return "вечора";
            }
        },

        ordinal: function (number, period) {
            switch (period) {
                case 'M':
                case 'd':
                case 'DDD':
                    return number + '-й';
                case 'D':
                    return number + '-го';
                case 'w':
                case 'W':
                    return number + '-я';
                default:
                    return number;
            }
        },

        week : {
            dow : 1, // Monday is the first day of the week.
            doy : 7  // The week that contains Jan 1st is the first week of the year.
        }
    });
}));