'use strict'

//Get a list of vehicles in inventory based on the classificationId

let classificationList = document.querySelector("#classificationList");
console.log(classificationList);
classificationList.addEventListener('change', function(){

    let classificationId = classificationList.value;

    console.log(`classificationId is: ${classificationId}`);

    let classIdURL = "/phpmotors/vehicles/index.php?action=getInventoryItems&classificationId=" + classificationId;

    fetch(classIdURL)
    .then(function(response){
        if(response.ok){
            return response.json();
        }
        throw Error("Network response was not OK");
    })
    .then(function(data){
        console.log(data);
        buildInventoryList(data);
    })
    .catch(function(error){
        console.log('There was a problem: ', error.message);
    })

})

function buildInventoryList(data){
    let inventoryDisplay = document.getElementById("inventoryDisplay");

    //Set up table labels
    let dataTable = '<thead>';
    dataTable += '<tr><th>Vehicle Name</th><td>&nbsp;</td><td>&nbsp;</td></tr>';
    dataTable += '</thead>';

    //Set up the table body
    dataTable += '<tbody>';

    data.forEach(function (element){
        console.log(element.invId + ", " + element.invModel);
        dataTable += `<tr><td>${element.invMake} ${element.invModel}</td>`;
        dataTable += `<td><a href='/phpmotors/vehicles?action=mod&invId=${element.invId}' title='Click to modify'>Modify</a></td>`;
        dataTable += `<td><a href='/phpmotors/vehicles?action=del&invId=${element.invId}' title='Click to delate'>Delate</a></td></tr>`;
    })
    dataTable += '</tbody>';

    inventoryDisplay.innerHTML = dataTable;
}
