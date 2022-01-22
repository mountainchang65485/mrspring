var map;
var now_s;
var temp_data = [{lat: 24.967749, lng: 121.191700},
			{ lat: 24.989691, lng: 121.313312 },
			{lat: 25.136678, lng: 121.506190}
		];
function doFirst() {
	navigator.geolocation.getCurrentPosition(succCallback);
}

function succCallback(arg) {
	var lati = arg.coords.latitude;
	var longi = arg.coords.longitude;

	// //HOME 
	// var lati = 25.0399182;
	// var longi = 121.5569454;
	var styledMapType = new google.maps.StyledMapType(
		[
		  {elementType: 'geometry', stylers: [{color: '#D2B58C'}]},
		  {elementType: 'labels.text.fill', stylers: [{color: '#523735'}]},
		  {elementType: 'labels.text.stroke', stylers: [{color: '#f5f1e6'}]},
		  {
			featureType: 'administrative',
			elementType: 'geometry.stroke',
			stylers: [{color: '#c9b2a6'}]
		  },
		  {
			featureType: 'administrative.land_parcel',
			elementType: 'geometry.stroke',
			stylers: [{color: '#dcd2be'}]
		  },
		  {
			featureType: 'administrative.land_parcel',
			elementType: 'labels.text.fill',
			stylers: [{color: '#ae9e90'}]
		  },
		  {
			featureType: 'landscape.natural',
			elementType: 'geometry',
			stylers: [{color: '#A89176'}]
		  },
		  {
			featureType: 'poi',
			elementType: 'geometry',
			stylers: [{color: '#A89176'}]
		  },
		  {
			featureType: 'poi',
			elementType: 'labels.text.fill',
			stylers: [{color: '#93817c'}]
		  },
		  {
			featureType: 'poi.park',
			elementType: 'geometry.fill',
			stylers: [{color: '#a5b076'}]
		  },
		  {
			featureType: 'poi.park',
			elementType: 'labels.text.fill',
			stylers: [{color: '#447530'}]
		  },
		  {
			featureType: 'road',
			elementType: 'geometry',
			stylers: [{color: '#f5f1e6'}]
		  },
		  {
			featureType: 'road.arterial',
			elementType: 'geometry',
			stylers: [{color: '#fdfcf8'}]
		  },
		  {
			featureType: 'road.highway',
			elementType: 'geometry',
            stylers: [{color: '#f8c967'}]
		  },
		  {
			featureType: 'road.highway',
			elementType: 'geometry.stroke',
			stylers: [{color: '#e9bc62'}]
		  },
		  {
			featureType: 'road.highway.controlled_access',
			elementType: 'geometry',
			stylers: [{color: '#e98d58'}]
		  },
		  {
			featureType: 'road.highway.controlled_access',
			elementType: 'geometry.stroke',
			stylers: [{color: '#db8555'}]
		  },
		  {
			featureType: 'road.local',
			elementType: 'labels.text.fill',
			stylers: [{color: '#806b63'}]
		  },
		  {
			featureType: 'transit.line',
			elementType: 'geometry',
			stylers: [{color: '#A89176'}]
		  },
		  {
			featureType: 'transit.line',
			elementType: 'labels.text.fill',
			stylers: [{color: '#8f7d77'}]
		  },
		  {
			featureType: 'transit.line',
			elementType: 'labels.text.stroke',
			stylers: [{color: '#ebe3cd'}]
		  },
		  {
			featureType: 'transit.station',
			elementType: 'geometry',
			stylers: [{color: '#A89176'}]
		  },
		  {
			featureType: 'water',
			elementType: 'geometry.fill',
			stylers: [{color: '#b9d3c2'}]
		  },
		  {
			featureType: 'water',
			elementType: 'labels.text.fill',
			stylers: [{color: '#92998d'}]
		  }
		],
		{name: 'Styled Map'});
	var xy = new google.maps.LatLng(lati, longi);
	now_s = xy;
	var mapBoard = document.getElementById('mapBoard');
	var options = {
		zoom: 10,
		center: xy,
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		mapTypeControlOptions: {
            mapTypeIds: ['roadmap', 'satellite', 'hybrid', 'terrain',
                    'styled_map']
          },
        disableDefaultUI: true
	};
	map = new google.maps.Map(mapBoard, options,styledMapType);
	var marker = new google.maps.Marker({
		position: xy,
		map: map
	});
	marker.setTitle('目前位置');
	map.mapTypes.set('styled_map', styledMapType);
	map.setMapTypeId('styled_map');
	var data = [
		{
			position: { lat: 24.967749, lng: 121.191700 },
			map: map,
			title: '資策會',
			animation: google.maps.Animation.BOUNCE,
			icon:'images/monkryMAP.png'
		},
		{
			position: { lat: 24.989691, lng: 121.313312 },
			map: map,
			title: '桃園',
			animation: google.maps.Animation.BOUNCE,
			icon:'images/monkryMAP.png'
		},
		{
			position: { lat: 25.136678, lng: 121.506190 },
			map: map,
			title: '北投',
			animation: google.maps.Animation.BOUNCE,
			icon:'images/monkryMAP.png'
		}
	];
	for (var i = 0; data.length > i; i++) {
		var marker = new google.maps.Marker(data[i]);
	}
}

function showInfo(shop) {
	switch (shop.id) {
        case 'sopMap01':
						getLocation(0);
						// 手機
    				document.getElementById('adress_m').innerHTML = '桃園市中壢區300號';
    				document.getElementById('phone_m').innerHTML = '03-3258778';
    				//桌機
    				document.getElementById('adress_c').innerHTML = '桃園市中壢區300號';
						document.getElementById('phone_c').innerHTML = '03-3258778';
						//幻燈片
						document.getElementsByClassName('an_roompic')[0].src ='images/01.PNG';
    				document.getElementsByClassName('text')[0].innerHTML ='中央店-煎餅房';
    				document.getElementsByClassName('an_roompic')[1].src = 'images/02.PNG';
						document.getElementsByClassName('text')[1].innerHTML ='中央店-君山房';
						document.getElementsByClassName('an_roompic')[2].src = 'images/03.PNG';
    				document.getElementsByClassName('text')[2].innerHTML ='中央店-奕廷房';

            break;
        case 'sopMap02':
						getLocation(1);
						// 手機
    				document.getElementById('adress_m').innerHTML = '桃園市桃園區400號';
    				document.getElementById('phone_m').innerHTML = '03-3585999';
    				//桌機
    				document.getElementById('adress_c').innerHTML = '桃園市桃園區400號';
						document.getElementById('phone_c').innerHTML = '03-3585999';
						//幻燈片
						document.getElementsByClassName('an_roompic')[0].src ='images/04.PNG';
    				document.getElementsByClassName('text')[0].innerHTML ='桃園店-煎餅房';
    				document.getElementsByClassName('an_roompic')[1].src = 'images/05.PNG';
						document.getElementsByClassName('text')[1].innerHTML ='桃園店-君山房';
						document.getElementsByClassName('an_roompic')[2].src = 'images/06.PNG';
    				document.getElementsByClassName('text')[2].innerHTML ='桃園店-奕廷房';
            break;
        case 'sopMap03':
						getLocation(2);
						// 手機
    				document.getElementById('adress_m').innerHTML = '台北市北投區500號';
    				document.getElementById('phone_m').innerHTML = '02-8759666';
    				//桌機
    				document.getElementById('adress_c').innerHTML = '台北市北投區500號';
						document.getElementById('phone_c').innerHTML = '02-8759666';
						//幻燈片
						document.getElementsByClassName('an_roompic')[0].src ='images/07.PNG';
    				document.getElementsByClassName('text')[0].innerHTML ='北投店-煎餅房';
    				document.getElementsByClassName('an_roompic')[1].src = 'images/08.PNG';
						document.getElementsByClassName('text')[1].innerHTML ='北投店-君山房';
						document.getElementsByClassName('an_roompic')[2].src = 'images/09.PNG';
    				document.getElementsByClassName('text')[2].innerHTML ='北投店-奕廷房';
            break;
    }
}
function getLocation(e) { //e:0, 1, 2

	// if (directionsDisplay != null) {
	// 	directionsDisplay.setMap(null);
	// 	directionsDisplay = null;
	// }
    var directionsService = new google.maps.DirectionsService();
		var directionsDisplay = new google.maps.DirectionsRenderer();
    // 放置路線圖層
    directionsDisplay.setMap(map);

    // 路線相關設定
    var request = {
        origin: now_s,
        destination: temp_data[e],
        travelMode: 'DRIVING'
    };

		// 繪製路線
    directionsService.route(request, function (result, status) {
        if (status == 'OK') {
            // 回傳路線上每個步驟的細節
						console.log(result.routes[0].legs[0].steps);
						console.log("result : ",result);
            directionsDisplay.setDirections(result);
        } else {
            console.log(status);
        }
    });
}
window.addEventListener('load', doFirst, false);