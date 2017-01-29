function getRootUrl () {
  return $('.baseUrl').val();
}
function removeResponseAjax() {
  $('.responseAjax').removeClass('alert-success');
  $('.responseAjax').removeClass('alert-danger');
  $('.responseAjax').removeClass('active');

}
function saveEvent (event) {
  var url = getRootUrl();
  var dataPost;
  dataPost = {
    title: event.title,
    start: event.start,
    end  : event.end,
    id   : event.event_id,
    name : event.name,
  };
  var data = JSON.stringify(dataPost);
  $.get(url+'/administrador/calendario/actualizar',{data:data}, function(response) {
    // render the event on the calendar
    // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
    event.id = response.data;
    $('#calendar').fullCalendar('renderEvent', event, true);
  });
}
function updateEvent (event) {
  var url = getRootUrl();
  var dataPost;
  if (event.allDay == false) {
    var allDay = 0;
  }else
  {
    var allDay = 1;
  }
  dataPost = {
    title     : event.title,
    start     : event.start,
    end       : event.end,
    event_id  : event.event_id,
    name      : event.name,
    id        : event.id,
    allDay    : allDay,
  };
  $.get(url+'/administrador/calendario/evento/actualizar',{data:JSON.stringify(dataPost)}, function(response) {
    
  });
}
function getEvents () {
  var url = getRootUrl();
  $.ajax({
    url: url+'/administrador/calendario/buscar',
    type: 'GET',
    dataType: 'json',
    success: function(response)
    {
      $.each(response.data, function(index, val) {
         if (val.allDay == 0) {
          val.allDay = false;
         };
      });
      $('#calendar').fullCalendar({
        header: {
          left: 'prev,next today',
          center: 'title',
          right: 'month,agendaWeek,agendaDay'
        },
        buttonText: {
          today: 'today',
          month: 'month',
          week: 'week',
          day: 'day'
        },
        //Random default events
        events: response.data,
        editable: true,
        droppable: true, // this allows things to be dropped onto the calendar !!!
        drop: function (date, allDay) { // this function is called when something is dropped
          var x = Math.random()+1000;
          var y = Math.random()+1000;
          // retrieve the dropped element's stored Event Object
          var originalEventObject = $(this).data('eventObject');

          // we need to copy it, so that multiple events don't have a reference to the same object
          var copiedEventObject = $.extend({}, originalEventObject);

          // assign it the date that was reported
          copiedEventObject.start = date;
          copiedEventObject.allDay = allDay;
          copiedEventObject.backgroundColor = $(this).css("background-color");
          copiedEventObject.borderColor = $(this).css("border-color");
          copiedEventObject.name = 'event-'+copiedEventObject.id+'-'+x+y;
          saveEvent(copiedEventObject);
        },
        eventResize: function( event, delta, revertFunc, jsEvent, ui, view ) {
          updateEvent(event);
        },
        eventRender: function( event, element, view ) {
          updateEvent(event);
        },
        eventResizeStop: function( event, jsEvent, ui, view ) { 
          console.log(event.end);
        }
      });
    }
  });
}
$(function () {
  
  /* initialize the external events
   -----------------------------------------------------------------*/
  function ini_events(ele) {
    ele.each(function () {

      // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
      // it doesn't need to have a start or end
      var eventObject = {
        title: $.trim($(this).text()), // use the element's text as the event title
        event_id   : $(this).data('id')
      };

      // store the Event Object in the DOM element so we can get to it later
      $(this).data('eventObject', eventObject);

      // make the event draggable using jQuery UI
      $(this).draggable({
        zIndex: 1070,
        revert: true, // will cause the event to go back to its
        revertDuration: 0  //  original position after the drag
      });

    });
  }
  ini_events($('#external-events div.external-event'));
  /* initialize the calendar
   -----------------------------------------------------------------*/
  //Date for the calendar events (dummy data)
  var date = new Date();
  var d = date.getDate(),
          m = date.getMonth(),
          y = date.getFullYear();
  getEvents();

  /* ADDING EVENTS */
  var currColor = "#3c8dbc"; //Red by default
  //Color chooser button
  var colorChooser = $("#color-chooser-btn");
  $("#color-chooser > li > a").click(function (e) {
    e.preventDefault();
    //Save color
    currColor = $(this).css("color");
    //Add color effect to button
    $('#add-new-event').css({"background-color": currColor, "border-color": currColor}).val(currColor);
  });
  $("#add-new-event").click(function (e) {
    e.preventDefault();
    //Get value and make sure it is not null
    var val = $("#new-event").val();
    if (val.length == 0) {
      return;
    }
    var boton = $(this);

    var dataPost = {
      title : val,
      color : boton.val(),
    }
    var url = getRootUrl();
    $.ajax({
      url: url+'/administrador/calendario/nuevo-evento',
      type: 'GET',
      dataType: 'json',
      data: dataPost,
      beforeSend:function()
      {
        $('.miniLoader').addClass('active');
        boton.addClass('disabled').attr('disabled',true);
      },
      success:function (response) {
        boton.removeClass('disabled').attr('disabled',false);
        $('.miniLoader').removeClass('active');
        $('.responseAjax').addClass('alert-'+response.type).addClass('active');
        if (response.type == 'success') {
          var i = $("<i />");
          i.addClass(response.msg);
          $('.responseAjax').children('p').html(i);
        }else
        {
          $('.responseAjax').children('p').html(response.msg);
        }
        //Create events
        var event_element = $("<div />");
        event_element.css({"background-color": currColor, "border-color": currColor, "color": "#fff"}).addClass("external-event");
        event_element.html(val);
        event_element.attr('data-id',response.data.id);
        $('#external-events').prepend(event_element);

        //Add draggable funtionality
        ini_events(event_element);

        //Remove event from text input
        $("#new-event").val("");
        setTimeout(removeResponseAjax,5000)
      },
      error: function()
      {
        boton.removeClass('disabled').attr('disabled',false);
        $('.miniLoader').removeClass('active');
      }

    })
  });
  
});


