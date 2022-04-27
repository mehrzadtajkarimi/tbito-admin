//    جدول جزئیات کاربران
$(document).ready(function () {


  $(".start_at").pDatepicker({
    "inline": false,
    "format": "YYYY/M/D",
    "viewMode": "day",
    "initialValue": false,
    "initialValueType": 'persian',
    "minDate": null,
    "maxDate": null,
    "autoClose": true,
    "position": "auto",
    "altFormat": "YYYY/M/D",
    "altField": "#start_at",
    "onlyTimePicker": false,
    "TimePicker": true,
    "onlySelectOnDate": true,
    "calendarType": "persian",
    "inputDelay": 800,
    "observer": true,
    "calendar": {
      "persian": {
        "locale": "fa",
        "showHint": true,
        "leapYearMode": "algorithmic"
      },
      "gregorian": {
        "locale": "en",
        "showHint": true
      }
    },
    "navigator": {
      "enabled": true,
      "scroll": {
        "enabled": true
      },
      "text": {
        "btnNextText": "<",
        "btnPrevText": ">"
      }
    },
    "toolbox": {
      "enabled": true,
      "calendarSwitch": {
        "enabled": true,
        "format": "HH:mm"
      },
      "todayButton": {
        "enabled": true,
        "text": {
          "fa": "امروز",
          "en": "Today"
        }
      },
      "submitButton": {
        "enabled": true,
        "text": {
          "fa": "تایید",
          "en": "Submit"
        }
      },
      "text": {
        "btnToday": "امروز"
      }
    },
    "timePicker": {
      "enabled": false,
      "step": "1",
      "hour": {
        "enabled": false,
        "step": false
      },
      "minute": {
        "enabled": false,
        "step": false
      },
      "second": {
        "enabled": false,
        "step": null
      },
      "meridian": {
        "enabled": null
      }
    },
    "dayPicker": {
      "enabled": true,
      "titleFormat": "YYYY MMMM"
    },
    "monthPicker": {
      "enabled": true,
      "titleFormat": "YYYY"
    },
    "yearPicker": {
      "enabled": true,
      "titleFormat": "YYYY"
    },
    "responsive": true,
  });
  $(".finish_at").pDatepicker({
    "inline": false,
    "format": "YYYY/M/D",
    "viewMode": "day",
    "initialValue": false,
    "initialValueType": 'persian',
    "minDate": null,
    "maxDate": null,
    "autoClose": true,
    "position": "auto",
    "altFormat": "YYYY/M/D",
    "altField": "#finish_at",
    "onlyTimePicker": false,
    "TimePicker": true,
    "onlySelectOnDate": true,
    "calendarType": "persian",
    "inputDelay": 800,
    "observer": true,
    "calendar": {
      "persian": {
        "locale": "fa",
        "showHint": true,
        "leapYearMode": "algorithmic"
      },
      "gregorian": {
        "locale": "en",
        "showHint": true
      }
    },
    "navigator": {
      "enabled": true,
      "scroll": {
        "enabled": true
      },
      "text": {
        "btnNextText": "<",
        "btnPrevText": ">"
      }
    },
    "toolbox": {
      "enabled": true,
      "calendarSwitch": {
        "enabled": true,
        "format": "HH:mm"
      },
      "todayButton": {
        "enabled": true,
        "text": {
          "fa": "امروز",
          "en": "Today"
        }
      },
      "submitButton": {
        "enabled": true,
        "text": {
          "fa": "تایید",
          "en": "Submit"
        }
      },
      "text": {
        "btnToday": "امروز"
      }
    },
    "timePicker": {
      "enabled": false,
      "step": "1",
      "hour": {
        "enabled": false,
        "step": false
      },
      "minute": {
        "enabled": false,
        "step": false
      },
      "second": {
        "enabled": false,
        "step": null
      },
      "meridian": {
        "enabled": null
      }
    },
    "dayPicker": {
      "enabled": true,
      "titleFormat": "YYYY MMMM"
    },
    "monthPicker": {
      "enabled": true,
      "titleFormat": "YYYY"
    },
    "yearPicker": {
      "enabled": true,
      "titleFormat": "YYYY"
    },
    "responsive": true
  });


  $("body").on('keyup', 'input.number_format', function () {
    var num = this.value.replace(/[^\d\.]/g, '');
    var parts = num.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, ',');
    this.value = parts.join(".");
  });






});