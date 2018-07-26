const body = document.body,
    app = document.getElementById("app"),
    mapContainer = document.getElementById("map-container"),
    cityList = document.getElementById("city-list"),
    cityListContainer = document.getElementById("city-list-container"),
    cityRows = cityListContainer.children[0].children[1].children,
    surveyData = document.getElementById("survey-data"),
    surveyDataContainer = document.getElementById("survey-data-container"),
    form1 = document.getElementById("city-form"),
    form2 = document.getElementById("survey-data-form"),
    button1 = document.getElementById("button-for-add-city-form"),
    button2 = document.getElementById("button-for-add-survey-data-form"),
    button3 = document.getElementById("button-for-add-city"),
    button4 = document.getElementById("button-for-update-city"),
    button5 = document.getElementById("button-for-reset-city-form"),
    button6 = document.getElementById("button-for-add-survey-data"),
    button7 = document.getElementById("button-for-update-survey-data"),
    button8 = document.getElementById("button-for-reset-survey-data-form"),
    field1 = document.getElementById("city-name"),
    field2 = document.getElementById("latitude"),
    field3 = document.getElementById("longitude"),
    field4 = document.getElementById("field-name"),
    field5 = document.getElementById("field-value"),
    eventHandler1 = button1.addEventListener("click", openAddCityForm),
    eventHandler2 = button2.addEventListener("click", openAddSurveyDataForm),
    eventHandler3 = button3.addEventListener("click", addCity),
    eventHandler4 = button4.addEventListener("click", updateCity),
    eventHandler5 = button5.addEventListener("click", resetCityForm),
    eventHandler6 = button6.addEventListener("click", addSurveyData),
    eventHandler7 = button7.addEventListener("click", updateSurveyData),
    eventHandler8 = button8.addEventListener("click", resetSurveyDataForm),
    ajax1 = new XMLHttpRequest(),
    ajax2 = new XMLHttpRequest(),
    ajax3 = new XMLHttpRequest(),
    ajax4 = new XMLHttpRequest(),
    ajax5 = new XMLHttpRequest(),
    ajax6 = new XMLHttpRequest(),
    ajax7 = new XMLHttpRequest(),
    ajax8 = new XMLHttpRequest();

var map = {},
    coordinates = [],
    fieldName = "",
    oldFieldName = "",
    cityId = 0,
    cityIdForUpdate = 0,
    cityIdForDelete = 0,
    descriptions = "";

setMapSurveyApp();

function addCity() {
    const receiverPath = "/map-survey/add-city.php?city_name=" + field1.value + "&latitude=" + field2.value + 
        "&longitude=" + field3.value;

    ajax4.open("GET", receiverPath);
    ajax4.send();
}

function updateCity() {
    if(cityIdForUpdate !== 0) {
        const receiverPath = "/map-survey/update-city.php?new_city_name=" + field1.value + "&city_id=" + cityIdForUpdate + "&new_latitude=" + 
            field2.value + "&new_longitude=" + field3.value;

        ajax2.open("GET", receiverPath);
        ajax2.send();
    }
}

function addSurveyData() {
    if(cityId !== 0) {
        const receiverPath = "/map-survey/add-data.php?field_name=" + field4.value + "&field_value=" + field5.value + "&city_id=" + cityId;

        ajax6.open("GET", receiverPath);
        ajax6.send();
    }
}

function updateSurveyData() {
    if(cityId !== 0) {
        const receiverPath = "/map-survey/update-data.php?old_field_name=" + oldFieldName + "&new_field_name=" + field4.value + 
            "&new_field_value=" + field5.value + "&city_id=" + cityId;

        ajax6.open("GET", receiverPath);
        ajax6.send();
    }
}

function resetCityForm() {
    field1.value = "";
    field2.value = "";
    field3.value = "";
}

function resetSurveyDataForm() {
    field4.value = "";
    field5.value = "";
}

function setCityId(parentElementId) {
    cityId = parentElementId;

    refresh2();
}

function openAddCityForm() {
    const y = mapContainer.offsetHeight + cityList.offsetHeight + surveyData.offsetHeight + 60;

    resetCityForm();

    if(button3.disabled) {
        button3.removeAttribute(button3.getAttribute("disabled"));
        button4.setAttribute("disabled", "disabled");

        form1.style.display = "block";
    }

    scrollTo(0, y);
    field1.focus();
}

function openUpdateCityForm(tempCityId, tempCityName, tempLatitude, tempLongitude) {
    const y = mapContainer.offsetHeight + cityList.offsetHeight + surveyData.offsetHeight + 60;

    resetCityForm();

    if(button4.disabled) {
        button4.removeAttribute(button4.getAttribute("disabled"));
        button3.setAttribute("disabled", "disabled");

        form1.style.display = "block";
    }

    scrollTo(0, y);
    field1.focus();

    field1.value = tempCityName;
    field2.value = tempLatitude;
    field3.value = tempLongitude;

    cityIdForUpdate = tempCityId;
}

function openAddSurveyDataForm() {
    if(cityId !== 0) {
        const y = mapContainer.offsetHeight + cityList.offsetHeight + surveyData.offsetHeight + 90;

        if(button6.disabled) {
            button6.removeAttribute(button6.getAttribute("disabled"));
            button7.setAttribute("disabled", "disabled");

            form2.style.display = "block";
        }

        resetSurveyDataForm();
        scrollTo(0, y);
        field4.focus();
    }
}

function openUpdateSurveyDataForm(tempOldFieldName, tempOldFieldValue) {
    if(cityId !== 0) {
        const y = mapContainer.offsetHeight + cityList.offsetHeight + surveyData.offsetHeight + 90;

        if(button7.disabled) {
            button7.removeAttribute(button7.getAttribute("disabled"));
            button6.setAttribute("disabled", "disabled");

            form2.style.display = "block";
        }

       
        resetSurveyDataForm(); scrollTo(0, y);
        scrollTo(0, y);
        field4.focus();

        field4.value = tempOldFieldName;
        field5.value = tempOldFieldValue;

        oldFieldName = tempOldFieldName;
    }
}

function deleteCity(tempCityId) {
    if(tempCityId !== 0) {
        cityIdForDelete = tempCityId;

        const receiverPath = "/map-survey/delete-city.php?city_id=" + tempCityId;

        ajax3.open("GET", receiverPath);
        ajax3.send();
    }
}

function createMap() {
    const mapSetting = {
        center: {lat: -6.121435, lng: 106.774124},
        zoom: 5
    },
        map = new google.maps.Map(mapContainer, mapSetting);

    var x = 0,
        y = new Array(),
        marker = {},
        coordinate = new Array(),
        infoWindow = {},
        description = "";

    if(cityRows[0].children[1]) {
        ajax8.open("GET", "/map-survey/get-data-v2.php", false);
        ajax8.send();

        for(; x < cityRows.length; ++x) {
            coordinates.push([cityRows[x].children[0].innerHTML, parseFloat(cityRows[x].children[1].innerHTML), parseFloat(cityRows[x].children[2].innerHTML)]);
        }

        for(x = 0; x < coordinates.length; ++x) {
            coordinate = {lat: coordinates[x][1], lng: coordinates[x][2]};
            description = descriptions[x];
            marker = new google.maps.Marker({
                position: coordinate,
                icon: "http://maps.google.com/mapfiles/ms/icons/blue-dot.png",
                map: map
            });
            infoWindow = new google.maps.InfoWindow();

            google.maps.event.addListener(marker, "click", (function(marker, description) {
                    return function() {
                        infoWindow.setContent(description);
                        infoWindow.open(map, marker);
                    }
                }
            )(marker, description));
        }
    }
}

function deleteSurveyData(tempFieldName) {
    if(cityId !== 0) {
        fieldName = tempFieldName;

        const receiverPath = "/map-survey/delete-data.php?field_name=" + tempFieldName + "&city_id=" + cityId;

        ajax7.open("GET", receiverPath);
        ajax7.send();
    }
}

function refresh1() {
    const receiverPath = "/map-survey/get-city.php";

    ajax1.open("GET", receiverPath);
    ajax1.send();
}

function refresh2() {
    const receiverPath = "/map-survey/get-data.php?city_id=" + cityId;

    ajax5.open("GET", receiverPath);
    ajax5.send();
}

function setMapSurveyApp() {
    ajax1.onreadystatechange = function() {
        if(this.readyState === 4 && this.status === 200) {
            cityListContainer.innerHTML = this.responseText;
        }
    };

    ajax2.onreadystatechange = function() {
        if(this.readyState === 4 && this.status === 200) {
            refresh1();

            if(cityIdForUpdate === cityId) {
                refresh2();
            }
        }
    };

    ajax3.onreadystatechange = function() {
        if(this.readyState === 4 && this.status === 200) {
            refresh1();

            if(cityIdForDelete === cityId) {
                form1.style.display = "none";
                form2.style.display = "none";

                cityId = 0;

                refresh2();
            }
        }
    };

    ajax4.onreadystatechange = function() {
        if(this.readyState === 4 && this.status === 200) {
            refresh1();
        }
    };

    ajax5.onreadystatechange = function() {
        if(this.readyState === 4 && this.status === 200) {
            surveyDataContainer.innerHTML = this.responseText;
        }
    };

    ajax6.onreadystatechange = function() {
        if(this.readyState === 4 && this.status === 200) {
            refresh2();
        }
    };

    ajax7.onreadystatechange = function() {
        if(this.readyState === 4 && this.status === 200) {
            refresh2();

            if(field4.value === fieldName) {
                form2.style.display = "none";

                button6.setAttribute("disabled", "disabled");
            }
        }
    };

    ajax8.onreadystatechange = function() {
        if(this.readyState === 4 && this.status === 200) {
            descriptions = JSON.parse(this.responseText);
        }
    };

    button3.setAttribute("disabled", "disabled");
    button4.setAttribute("disabled", "disabled");

    button6.setAttribute("disabled", "disabled");
    button7.setAttribute("disabled", "disabled");

    scrollTo(0, mapContainer.offsetHeight);

    app.style.visibility = "visible";
}