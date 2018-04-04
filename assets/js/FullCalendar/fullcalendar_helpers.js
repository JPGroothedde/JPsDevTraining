/**
 * Created by johangriesel on 06122016.
 */
function modifyEvent(event,title,start,end) {
    if (!event)
        return;
    if (title)
        event.title = title;
    if (start) {
        event.start = moment(start);
    }
    if (end)
        event.end = moment(end);
}
function postEvent(event,formId,actionId) {
    if (!event)
        return;

}
function getFullCalendarEventJson(event,date,type) {
    type = type || 'new';
    date = date || moment().format('MMMM Do YYYY, h:mm:ss');
    var jsonObj;
    if (!event)
        jsonObj = {"Type":type,"Date":date};
    else
        jsonObj = {"Type":type,"Date":null,"EventId":event.id,"EventTitle":event.title,"EventStart":event.start,"EventEnd":event.end};
    return JSON.stringify(jsonObj);
}