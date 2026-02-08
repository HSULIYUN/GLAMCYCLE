// 初始化日期選擇器
document.addEventListener('DOMContentLoaded', function() {
    // 初始化日期選擇器
    flatpickr("#start-date-picker", {
        dateFormat: "Y-m-d"
    });
    flatpickr("#end-date-picker", {
        dateFormat: "Y-m-d"
    });

    // 页面加载时获取并显示所有活动
    fetchAllEvents();

    // 监听两个日期选择器的变化
    document.getElementById('start-date-picker').addEventListener('change', fetchEventsInRange);
    document.getElementById('end-date-picker').addEventListener('change', fetchEventsInRange);
});

// 获取所有活动的函数
function fetchAllEvents() {
    fetch('fetch-events.php')
        .then(response => response.json())
        .then(data => {
            displayEvents(data); // 使用通用的展示活动函数
        })
        .catch(error => console.error('Error:', error));
}

// 根据日期范围获取活动的函数
function fetchEventsInRange() {
    const startDate = document.getElementById('start-date-picker').value;
    const endDate = document.getElementById('end-date-picker').value || startDate; // 如果没有选择结束日期，则默认为开始日期

    // 确保至少选择了开始日期
    if (!startDate) return;

    fetch(`fetch-events.php?start=${startDate}&end=${endDate}`)
        .then(response => response.json())
        .then(data => {
            displayEvents(data); // 使用通用的展示活动函数
        })
        .catch(error => console.error('Error:', error));
}

// 通用的展示活动函数
function displayEvents(data) {
    const container = document.getElementById('events-container');
    container.innerHTML = ''; // 清空当前内容
    if (data.length > 0) {
        data.forEach(event => {
            // 创建活动卡片
            const eventDiv = document.createElement('div');
            eventDiv.classList.add('event');
            eventDiv.setAttribute('data-event-id', event.EventID);  // 确保为每个事件设置data-event-id属性

            // 添加图片
            const img = document.createElement('img');
            img.src = event.ImagePath.startsWith('http') ? event.ImagePath : `${event.ImagePath}`;
            img.alt = "Event Images";

            // 添加活动信息
            const infoDiv = document.createElement('div');
            infoDiv.classList.add('event-info');

            // 活动名称
            const titleDiv = document.createElement('div');
            titleDiv.classList.add('event-title');
            titleDiv.textContent = event.EventName;

            const dateContainer = document.createElement('div');
            dateContainer.style.display = 'flex'; // 保持使用 Flexbox 布局
            dateContainer.style.flexDirection = 'column'; // 子元素将堆叠在垂直方向上
            dateContainer.style.width = '100%'; // 容器宽度设置为 100%

            // 活动开始日期与时间
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

            // 活动简介
            const descriptionDiv = document.createElement('div');
            descriptionDiv.classList.add('event-description');
            descriptionDiv.textContent = event.EventDescription;

            // 活动类型
            const eventTypeDiv = document.createElement('div');
            eventTypeDiv.classList.add('event-type');
            eventTypeDiv.textContent = event.EventType; // 使用从数据库获取的 EventType 字段
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

            // 组装卡片
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
