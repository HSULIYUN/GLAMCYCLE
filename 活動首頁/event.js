
document.addEventListener('DOMContentLoaded', function() {
    
    flatpickr("#start-date-picker", {
        dateFormat: "Y-m-d"
    });
    flatpickr("#end-date-picker", {
        dateFormat: "Y-m-d"
    });


    fetchAllEvents();


    document.getElementById('start-date-picker').addEventListener('change', fetchEventsInRange);
    document.getElementById('end-date-picker').addEventListener('change', fetchEventsInRange);
});


function fetchAllEvents() {
    fetch('fetch-events.php')
        .then(response => response.json())
        .then(data => {
            displayEvents(data); 
        })
        .catch(error => console.error('Error:', error));
}


function fetchEventsInRange() {
    const startDate = document.getElementById('start-date-picker').value;
    const endDate = document.getElementById('end-date-picker').value || startDate; 

  
    if (!startDate) return;

    fetch(`fetch-events.php?start=${startDate}&end=${endDate}`)
        .then(response => response.json())
        .then(data => {
            displayEvents(data); 
        })
        .catch(error => console.error('Error:', error));
}


function displayEvents(data) {
    const container = document.getElementById('events-container');
    container.innerHTML = ''; 
    if (data.length > 0) {
        data.forEach(event => {
 
            const eventDiv = document.createElement('div');
            eventDiv.classList.add('event');
            eventDiv.setAttribute('data-event-id', event.EventID);  

     
            const img = document.createElement('img');
            img.src = event.ImagePath.startsWith('http') ? event.ImagePath : `${event.ImagePath}`;
            img.alt = "Event Images";

          
            const infoDiv = document.createElement('div');
            infoDiv.classList.add('event-info');

           
            const titleDiv = document.createElement('div');
            titleDiv.classList.add('event-title');
            titleDiv.textContent = event.EventName;

            const dateContainer = document.createElement('div');
            dateContainer.style.display = 'flex';
            dateContainer.style.flexDirection = 'column'; 
            dateContainer.style.width = '100%'; 


            const dateDiv = document.createElement('div');
            dateDiv.classList.add('event-date');
            const startDateTime = new Date(event.StartDateTime);
            const startDateFormatted = `${startDateTime.getFullYear()}/${(startDateTime.getMonth() + 1).toString().padStart(2, '0')}/${startDateTime.getDate().toString().padStart(2, '0')}`;
            const startTimeFormatted = `${startDateTime.getHours().toString().padStart(2, '0')}:${startDateTime.getMinutes().toString().padStart(2, '0')}`;
            dateDiv.innerHTML = `<i class="far fa-clock"></i> 開始日期：${startDateFormatted} ${startTimeFormatted}`;

            const endDateDiv = document.createElement('div');
            endDateDiv.classList.add('event-date');
            const endDateTime = new Date(event.EndDateTime);
            const endDateFormatted = `${endDateTime.getFullYear()}/${(endDateTime.getMonth() + 1).toString().padStart(2, '0')}/${endDateTime.getDate().toString().padStart(2, '0')}`;
            const endTimeFormatted = `${endDateTime.getHours().toString().padStart(2, '0')}:${endDateTime.getMinutes().toString().padStart(2, '0')}`;
            endDateDiv.textContent = `結束日期：${endDateFormatted} ${endTimeFormatted}`;

       
            const descriptionDiv = document.createElement('div');
            descriptionDiv.classList.add('event-description');
            descriptionDiv.textContent = event.EventDescription;

         
            const eventTypeDiv = document.createElement('div');
            eventTypeDiv.classList.add('event-type');
            eventTypeDiv.textContent = event.EventType; 
            switch (event.EventType) {
                case '特展':
                    eventTypeDiv.classList.add('event-special');
                    break;
                case '課程':
                    eventTypeDiv.classList.add('event-course');
                    break;
                default:
                    eventTypeDiv.classList.add('event-other');
            }

           
            infoDiv.appendChild(eventTypeDiv);
            infoDiv.appendChild(titleDiv);
            infoDiv.appendChild(dateDiv);
            infoDiv.appendChild(endDateDiv);
            dateContainer.appendChild(dateDiv);
            dateContainer.appendChild(endDateDiv);

            infoDiv.appendChild(dateContainer);
            infoDiv.appendChild(descriptionDiv);

            eventDiv.appendChild(img);
            eventDiv.appendChild(infoDiv);

            eventDiv.addEventListener('click', () => {
                const eventId = eventDiv.getAttribute('data-event-id');
                if (eventId) {
                    window.location.href = `活動內頁/metal0.php?id=${eventId}`;
                } else {
                    console.error('Event ID is null or undefined');
                }
            });

            container.appendChild(eventDiv);
        });
    } else {
        const noEventsText = document.createElement('p');
        noEventsText.textContent = '您所選時段目前沒有活動，或是未選擇結束日期。';
        noEventsText.style.textAlign = 'center';
        noEventsText.style.marginTop = '10px';

        container.appendChild(noEventsText);
    }
}
