const deliveryStartDay = document.getElementById('deliveryStartDate');
const deliveryEndDay = document.getElementById('deliveryEndDate');
let days = 1;

const fullDate = new Date(Date.now() + (days * 24 * 60 * 60 * 1000));
const result = `${fullDate.getFullYear()}-${fullDate.getMonth() + 1}-${fullDate.getDate()}`;//Нумерация месяцев начинается с нуля, поэтому getMonth() + 1

deliveryStartDay.setAttribute("min", `${result}`);
deliveryEndDay.setAttribute("min", `${result}`);
