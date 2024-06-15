let menu_btn = document.querySelector('.menu_btn'), 
menu = document.querySelector('.menu'), 
rotate = document.querySelector('.menu_btn');
menu_btn.addEventListener('click', function(e){menu.classList.toggle('active'); 
rotate.classList.toggle('rotate')});
let counter = 0;
let first;
first = "<div class='text_block ADD'><input type='text' class='text_block_nameADD' placeholder='Добавьте название раздела...' name='part_name" + counter + "'><textarea class='article_textADD' placeholder='Добавьте текст раздела...' name='part_text" + counter + "'></textarea></div>";
function function1() {
    first = '<div class="text_block ADD"><input type="text" class="text_block_nameADD" placeholder="Добавьте название раздела..." name="part_name' + counter + '"><textarea class="article_textADD" placeholder="Добавьте текст раздела..." name="part_text' + counter + '"></textarea></div>';
    document.getElementById("input_block").insertAdjacentHTML("beforeend", first);
    counter++;
    alert(counter);
};
const button = document.querySelector('#partADD');
button.addEventListener('click', function1);

