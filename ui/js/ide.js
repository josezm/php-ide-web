let editor;

window.onload = function () {
  editor = ace.edit('editor');
  editor.setTheme('ace/theme/nord_dark');
  editor.session.setMode('ace/mode/javascript');
};

function changeLanguage() {
  let language = $('#languages').val();

  if (language == 'c' || language == 'cpp')
    editor.session.setMode('ace/mode/c_cpp');
  else if (language == 'php') editor.session.setMode('ace/mode/php');
  else if (language == 'python') editor.session.setMode('ace/mode/python');
  else if (language == 'javascript')
    editor.session.setMode('ace/mode/javascript');

  $('.output').text('>>');
  $('#language-name').text(language.toUpperCase());
}

function executeCode() {
  $.ajax({
    url: '/ide/app/compiler.php',

    method: 'POST',

    data: {
      language: $('#languages').val(),
      code: editor.getSession().getValue()
    },

    success: function (response) {
      $('.output').text(response);
    }
  });
}
