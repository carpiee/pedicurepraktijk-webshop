<?php


?>
<style>
.grid {
    position: relative;
}

.item {
    display: block;
    position: absolute;
    margin: 5px;
    z-index: 1;
    background: #000;
    color: #fff;
}

.item.muuri-item-dragging {
    z-index: 3;
}

.item.muuri-item-releasing {
    z-index: 2;
}

.item.muuri-item-hidden {
    z-index: 0;
}

.item-content {
    position: relative;
    width: 100%;
    height: 100%;
    cursor: pointer;
    background: #59687d;
    text-align: center;
}

#right_panel {
    position: absolute;
    width: 96px;
    padding-left: 4px;
    height: 100%;
    right: 0;
    background-color: #f0f0ff;
}

#right_panel:after {
    content: " ";
    background-color: #ccc;
    position: absolute;
    left: 0;
    width: 4px;
    height: 100%;
    cursor: w-resize;
}

</style>
<div class="w-full bg-gray-300">
    <div class="flex justify-center">
        <h1 class="text-xl font-semibold py-4">Bewerk de header van de webshop</h1>
    </div>
    <div class="flex p-4">
        <select class="colom py-1 px-2 font-semibold">
            <option value="0">Kies aantal kolommen</option>
            <option id="1" value="1">Make 1 cols</option>
            <option id="2" value="2">Make 2 cols</option>
            <option id="3" value="3">Make 3 cols</option>
        </select>
        <div id="voeg_item_toe" class="flex cursor-pointer">
            <div class="ml-4 rounded-full bg-white shadow-lg h-6 w-6 flex items-center justify-center
        ">
                <span class="text-gray-400 text-sm"><i class="fas fa-plus"></i></span>
            </div>
            <div class="px-2">
                <h1 class="font-semibold">
                    Voeg een item toe
                </h1>
            </div>
        </div>


    </div>
    <div class="bg-gray-400 h-px shadow"></div>
    <div class="header container h-screen w-full mb-20">
        <div id="cms" class="relative max-w-7xl px-4">
            <?php 
        $content = $cms->GetContent();
        echo $content->context;
        ?>
        </div>
    </div>

</div>

<div id="edit" style="top:9%;" class="fixed right-0 overflow-y-auto rounded-b-lg bg-white px-4 py-2 max-w-xs z-50">
    <div class="flex justify-between">
        <div class="text-teal-900 font-semibold text-md">
            <h1 class="text-xl font-semibold">Bewerk dit item</h1>
            <button class="bg-green-400 text-white font-semibold py-1 px-2 rounded-lg"
                id="downloadLink">Opslaan</button>
            <button id="delete_item">Verwijder item</button>
        </div>
        <span class="font-bold cursor-pointer" onclick="verberg(this)">X</span>
    </div>
    <hr class="mt-4">
    <h2 class="font-semibold text-lg tracking-wider mb-2">Content</h2>
    <div class="">
        <span class="block mr-2 text-sm">Voeg text toe</span>
        <input class="border-2 rounded-lg px-2 py-px w-full" type="text" name="text" id="tekst"
            onchange="VoegTextToe(this.value);" placeholder="Voeg tekst toe">
    </div>
    <div class="my-2">
        <span class="block mr-2 text-sm">Voeg een plaatje toe</span>
        <input class="border-2 rounded-lg px-2 py-px w-full" type="file" name="img" onchange="VoegImgToe(this);"
            value="Voeg img toe">
    </div>
    <button id="verwijder_img">Verwijder image</button>

    <input class="my-2" type="text" name="link" id="edit_link" placeholder="http://www.example.com"
        onchange="EditUrl(this.value);">

    <hr>
    <h2 class="font-semibold text-lg tracking-wider">Kleuren</h2>
    <div class="flex items-center py-2">
        <span class="block mr-2 text-sm">Achtergrond</span>
        <input type="color" id="body" name="body" value="#f6b73c" onchange="changebg(this.value);">
    </div>
    <div class="flex items-center py-2">
        <span class="block mr-2 text-sm">Tekst kleur</span>
        <input type="color" id="body" name="body" value="#f6b73c" onchange="changetekst(this.value);">
    </div>

    <hr>
    <h2 class="font-semibold text-lg tracking-wider">Maten</h2>
    <div class="">
        <span class="block mr-2 text-sm">breedte</span>
        <input type="number" id="width" placeholder="width" value="250">
    </div>

    <div class="">
        <span class="block mr-2 text-sm">hoogte</span>
        <input type="number" id="height" placeholder="height" value="97">
    </div>
    <h2 class="font-semibold text-lg tracking-wider">
        Centeren
    </h2>
    <span class="text-xs font-thin">(Alleen voor plaatjes en texten)</span>
    <div class="flex justify-between">
        <div class="flex items-center">
            <span class="block mr-2 text-sm">Horizontaal</span>
            <input type="checkbox" name="horizontaal" id="horizontaal">
        </div>

        <div class="flex items-center mr-6">
            <span class="block mr-2 text-sm">Verticaal</span>
            <input type="checkbox" name="verticaal" id="verticaal">
        </div>
    </div>
    <span class="text-xs font-thin">Centreer in midden van scherm</span>
    <div class="flex justify-between">
        <div class="flex items-center">
            <span class="block mr-2 text-sm">Horizontaal scherm</span>
            <input type="checkbox" id="mx-auto">
        </div>
        <div class="flex items-center mr-6">
            <span class="block mr-2 text-sm">Verticaal scherm</span>
            <input type="checkbox" id="my-auto">
        </div>
    </div>

</div>
<script src="https://unpkg.com/web-animations-js@2.3.2/web-animations.min.js"></script>
<script src="https://unpkg.com/muuri@0.8.0/dist/muuri.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.js"
    integrity="sha256-GMd3rFxMDNnM5JQEpiKLLl8kSrDuG5egqchk758z59g=" crossorigin="anonymous"></script>
<script>
var grid = new Muuri("#cms", {
    dragEnabled: true,
    layout: {
        fillGaps: false,
        horizontal: false,
    }
});
</script>
<script src="https://cdn.jsdelivr.net/npm/interactjs/dist/interact.min.js"></script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"
    integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
<script>
$("#edit").draggable();
interact('.item')
// .draggable({
//     onmove: function(event) {
//         const target = event.target;

//         const dataX = target.getAttribute('data-x');
//         const dataY = target.getAttribute('data-y');
//         const initialX = parseFloat(dataX) || 0;
//         const initialY = parseFloat(dataY) || 0;

//         const deltaX = event.dx;
//         const deltaY = event.dy;

//         const newX = initialX + deltaX;
//         const newY = initialY + deltaY;

//         target
//             .style
//             .transform = `translate(${newX}px, ${newY}px)`;

//         target.setAttribute('data-x', newX);
//         target.setAttribute('data-y', newY);
//     }
// });

function downloadInnerHtml(filename, elId, mimeType) {
    var elHtml = document.getElementById(elId).innerHTML;

    var link = document.createElement('a');
    mimeType = mimeType || 'text/plain';

    link.setAttribute('download', filename);
    link.setAttribute('href', 'data:' + mimeType + ';charset=utf-8,' + encodeURIComponent(elHtml));
    link.click();
}

var fileName = 'tags.html'; // You can use the .txt extension if you want

$('#downloadLink').click(function() {
    if ($("#cms #item").removeClass("border-2 border-green-400 bg-red-600")) {
        var header = $("#cms").html();
        if (header != ' ') {
            $.ajax({
                type: "POST",
                url: './fetch.php',
                data: {
                    header: header
                },
                success: function() {

                }
            });
        } else {
            alert('U moet eerst wat hebben gemaakt');
        }

    }

});


$("#width").bind("keyup mouseup", function() {
    $(".border-green-400").width(this.value);
});
$("#height").bind("keyup mouseup", function() {
    $(".border-green-400").height(this.value);
});


$("#horizontaal").click(function() {
    if ($('.border-green-400').hasClass("justify-center")) {
        $('.border-green-400').removeClass("justify-center");
    } else {
        $('.border-green-400').addClass("justify-center");
    }
});

$("#mx-auto").click(function() {
    if ($('.border-green-400').hasClass("translate-x-0")) {
        $('.border-green-400').removeClass("translate-x-0");
    } else {
        $('.border-green-400').addClass("translate-x-0");
    }
});

$("#my-auto").click(function() {
    if ($('.border-green-400').hasClass("translate-y-0")) {
        $('.border-green-400').removeClass("translate-y-0");
    } else {
        $('.border-green-400').addClass("translate-y-0");
    }
});

$("#verticaal").click(function() {
    if ($('.border-green-400').hasClass("items-center")) {
        $('.border-green-400').removeClass("items-center");
    } else {
        $('.border-green-400').addClass("items-center");
    }
    var grid = new Muuri("#cms", {
        dragEnabled: true,
        layout: {
            fillGaps: false,
            horizontal: false,
        }
    });
});


function VoegTextToe(input) {
    if ($(".border-green-400 p").length) {
        $(".border-green-400 p").text(input);
    } else {
        $(".border-green-400").append('<p class="text-white" id="tekst">' + input + '</p>');
    }

}

function VoegImgToe(input) {
    $('.fetch_results').find('input:file').val('');
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $(".border-green-400").append('<img class="w-56" src="' + e.target.result +
                '">');
            e.preventDefault();
        };

        reader.readAsDataURL(input.files[0]);
    }
}


function EditUrl(input) {
    $(".border-green-400 a").attr("href", input);
}

function verberg() {
    $("#edit").hide();
}
$("#cms").on('click', 'div.item', function() {
    $("#tekst").val('');
    $("#edit").show();
    if ($(this).hasClass('border-2 border-green-400')) {
        $(this).removeClass("border-2 border-green-400");
    } else {
        $(this).addClass('border-2 border-green-400');
        $("#tekst").val($(".border-green-400 p").text());
    }

});

$("#delete_item").click(function() {
    $("div").remove(".border-green-400");
});

$("#verwijder_img").click(function() {
    $(".border-green-400 img").remove();
});


$("#3_cols").click(function() {
    if ($('#item').length) {
        $('<div class="w-1/4 h-64 absolute m-5 item bg-red-600 m-4" id="item"><div class="item-content"><p>links</p></div></div>')
            .insertAfter(
                '#item'
            );
        $('<div class="w-1/2 h-64 absolute m-5 item bg-red-600 m-4" id="item"><div class="item-content"><p>midden</p></div></div>')
            .insertAfter(
                '#item'
            );
        $('<div class="w-1/4 h-64 absolute m-5 item bg-red-600 m-4" id="item"><div class="item-content"><p>rechts</p></div></div>')
            .insertAfter(
                '#item'
            );
    } else {
        $('#cms')
            .append(
                '<div class="w-1/4 h-64 absolute left-0 m-5 item bg-red-600 m-4 item" id="item"><div class="item-content"><p>rechts</p></div></div>'
            );
        $('#cms')
            .append(
                '<div class="w-1/2 h-64 absolute m-5 item bg-red-600 m-4 item" id="item"><div class="item-content"><p>rechts</p></div></div>'
            );
        $('#cms')
            .append(
                '<div class="w-1/4 h-64 absolute right-0 m-5 item bg-red-600 m-4 item" id="item"><div class="item-content"><p>rechts</p></div></div>'
            );
    }
    var grid = new Muuri("#cms", {
        dragEnabled: true,
        layout: {
            fillGaps: false,
            horizontal: false,
        }
    });
});


$("#voeg_item_toe").click(function() {
    if ($('#item').length) {
        $('<div class="w-auto h-64 absolute m-5 item bg-red-600 m-4" id="item"><div class="item-content"><p>remco</p></div></div>')
            .insertAfter(
                '#item'
            );
    } else {
        $('#cms')
            .append(
                '<div class="w-1/4 h-64 absolute m-5 item bg-red-600 m-4" id="item"><div class="item-content"><p>rechts</p></div></div>'
            );
        $('#cms')
            .append(
                '<div class="w-5/12 h-64 absolute m-5 item bg-red-600 m-4" id="item"><div class="item-content"><p>rechts</p></div></div>'
            );
        $('#cms')
            .append(
                '<div class="w-1/4 h-64 absolute m-5 item bg-red-600 m-4" id="item"><div class="item-content"><p>rechts</p></div></div>'
            );
    }
    var grid = new Muuri("#cms", {
        dragEnabled: true,
        layout: {
            fillGaps: false,
            horizontal: false,
        }
    });
});

function changebg(color) {
    console.log(color);
    $(".border-green-400").removeClass('bg-red-600').css('background-color', color);
}

function changetekst(color) {
    console.log(color);
    $(".border-green-400 p").removeClass('bg-red-600').css('color', color);
}

// $("select.colom").change(function() {
//     var aantal = $(this).children("option:selected").val();
//     console.log(aantal);
//     if (aantal > 0) {
//         $("div").remove(".item");
//         for (i = 0; i < aantal; i++) {
//             $('.header').append(
//                 '<div style="min-width:100px;min-height:60px;" class="item bg-red-600 m-4" id="item" />'
//             );
//         }
//     } else {
//         $("div").remove(".item");
//     }


// });
</script>
