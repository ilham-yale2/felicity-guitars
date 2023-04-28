$('.brand-list li').click(function() {
    if ($(this).find('.child').css('display') == 'none') {
        $(this).find('.child').slideDown();
        $(".brand-list li").not(this).find('.child').slideUp();
        $(this).find('.arr').addClass('rotate')
        $(".brand-list li").not(this).find('.arr').removeClass('rotate');
        $(this).find('.main').addClass('text-orange')
        $(".brand-list li").not(this).find('.main').removeClass('text-orange');
    } else {
        $(this).find('.iconify').removeClass('rotate')
        $(this).find('.main').removeClass('text-orange')
    }
    $('.parent').click(function() {
        $('.child').slideUp()
    })
});
function redirect(url){
    window.location.href=url
}

function country(value,name, custom = false){
    var html = 
    `
    <li class="text-capitalize">
        <a class="filter text-gold" href="${base_url}/browse-brand?brd=${brand}&country=${value}"><span class="text-country">${brand}</span> ${name}</a>
    </li>

    `
    if(custom){
        var html = 
        `
        <li class="">
            <a class="filter text-gold" href="${base_url}/browse-brand?brd=${brand}&country=${value}"><span class="text-country"></span> ${name}</a>
        </li>
    
        `  
    }
    return html

}


function changeBrand(id,name, img){
    $('#brandImg').attr('src', `${base_url}/storage/${img}`)

    $('.child li').removeClass('text-orange')
    $(`.list-${id}`).addClass('text-orange')
    $('.text-country').text(`${name}`)
    setCountry(name)
    $('.filter').each(function(index){
        var url = $(this).attr('href').replace(brand, name)
        $(this).attr('href', url)
    })

    brand = name
}

function setCountry(brand){
    var html;
    var custom = country(1,'Custom')
    var memphis = country(2, 'Memphis')
    var montana = country(3, 'Montana')
    var usa = country(4, 'U.S.A.')
    var mexico = country(5, 'Mexico')
    var china = country(6,'China')
    var historic = country(7, 'Custom Historic')
    var japan = country(8, 'Japan')
    var korea = country(9, 'Korea')
    var indonesia = country(10, 'Indonesia')
    var asia = country(11, 'Asia')
    var uk = country(12, 'U.K.')
    var denmark = country(13, 'Denmark')
    switch(brand) {
        case "Fender":
            html = usa + country(7, 'Custom Shop') + japan + mexico 
            break;
        case "Rickenbacker":
            html = usa
            break;
        case "Gibson":
            html = usa + custom + historic + memphis + montana + country(0, 'Epiphone by Gibson', true)
            break;
        case "Ibanez":
            html = japan
            break;
        case "Gretsch":
            html = usa + country(0, 'Custom Shop', true) + japan + korea
            break;
        case "Kitharra":
            html = indonesia
            break;
        case "ESP":
            html = usa + country(0, 'LTD')
            break;
        case "Epiphone":
            html = usa + asia
            break;
        case "PRS":
            html = country(0,'Paul Reed Smith', true) + country(0,'Paul Reed Smith SE', true)
            break;
        case 'Positive Grid':
            html = usa
            break;
        case "Vox" :
            html = uk
            break;
        case "Peavy" :
            html = usa
            break;
        case "Orange": 
            html = uk
            break;
        case "Marshall":
            html = uk
            break;
        case "Big Muff":
            html = usa
            break;
        case "BOSS":
            html = japan
            break;
        case "EarthQuaker Devices":
            html = usa
            break;
        case "Electro-Harmonix":
            html = usa
            break;
        case "Jim Dunlop":
            html = usa
            break;
        case "MXR":
            html = usa
            break;
        case "Stymon":
            html = usa
            break;
        case "TC Electronic":
            html = denmark
            break;
        case "Wampler":
            html = usa
            break;
        case "Waza Craft":
            html = usa
            break;
        default:
    }

    $('#country').html(html)
}   

function type(type, text){
    var html = `
        <li>
            <a class="filter" href="${base_url}/browse-brand?subject=${subject}&brd=${brand}&type=${type}"><span>${text}</span></a>
        </li>
    `
    return html
}

function setType(brand){
    var html 

    switch (brand) {
        case 'Fender':
            html =  type('solidbody', 'Solidbody') + type('semi-hollowbody') + type('offset', 'Offset') + type('acoustic', 'Acoustic')
            break;
        case 'Gibson':
            html =  type('solidbody', 'Solidbody') + type('semi-hollowbody') + type('offset', 'Offset') + type('hollowbody', 'Hollowbody') + type('acoustic', 'Acoustic')
            break;
    
        case 'Gretsch':
            html =  type('solidbody', 'Solidbody') + type('semi-hollowbody', 'Semi-hollowbody') + type('hollowbody', 'Hollowbody') 
            break;
        case 'Rickenbacker':
            html =  type('6-string', '6-String') + type('12-string', '12-String') + type('bass', 'Bass') 
            break;
        case 'ESP':
            html =  type('solidbody', 'Solidbody') + type('semi-hollowbody', 'Semi-hollowbody') + type('offset', 'Offset') 
            break;
        case 'Ibanez':
            html =  type('solidbody', 'Solidbody') + type('semi-hollowbody', 'Semi-hollowbody') + type('hollowbody', 'Hollowbody') 
            break;
        case 'PRS':
            html =  type('solidbody', 'Solidbody') + type('semi-hollowbody', 'Semi-hollowbody') + type('offset', 'Offset') + type('acoustic', 'Acoustic') 
            break;
    
        default:
            break;
    }

    $('#type-list').html(html)
}

