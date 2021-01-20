function input(type){
    var dayInto = $("#dayInto").val();
    var dtDayInto = new Date(dayInto); //#dayIntoに入力された日付を取得

    var take_1 = dtDayInto;
    var fm_take_1 = `${take_1.getFullYear()}/${take_1.getMonth()+1}/${take_1.getDate()}`.replace(/\n|\r/g, ''); //日付を文字列の形に変換

    var take_2 = dtDayInto.setDate(dtDayInto.getDate() + 1); //取得した現在の日付（dtDayInto）に1日足したもの
    var take_2 = new Date(take_2); //これを数字の羅列から日付に変換
    var fm_take_2 = `${take_2.getFullYear()}/${take_2.getMonth()+1}/${take_2.getDate()}`.replace(/\n|\r/g, ''); //日付を文字列の形に変換

    // これ以降、dtDayIntoには、一つ前に代入された値が代入されていくことになる。
    var take_3 = dtDayInto.setDate(dtDayInto.getDate() + 3);
    var take_3 = new Date(take_3);
    var fm_take_3 = `${take_3.getFullYear()}/${take_3.getMonth()+1}/${take_3.getDate()}`.replace(/\n|\r/g, '');

      if(type == 1){

          var type_1_text = $("#type_1").val();
          $("#type").val(type_1_text);
          var take_4 = dtDayInto.setDate(dtDayInto.getDate() + 4);
          var take_4 = new Date(take_4);
          var fm_take_4 = `${take_4.getFullYear()}/${take_4.getMonth()+1}/${take_4.getDate()}`.replace(/\n|\r/g, '');

          var take_5 = dtDayInto.setDate(dtDayInto.getDate() + 7);
          var take_5 = new Date(take_5);
          var fm_take_5 = `${take_5.getFullYear()}/${take_5.getMonth()+1}/${take_5.getDate()}`.replace(/\n|\r/g, '');

          $("#take_1").val(fm_take_1);
          $("#take_2").val(fm_take_2);
          $("#take_3").val(fm_take_3);
          $("#take_4").val(fm_take_4);
          $("#take_5").val(fm_take_5);

      } else if(type == 2) {

          var type_2_text = $("#type_2").val();
          $("#type").val(type_2_text);
          var take_4 = dtDayInto.setDate(dtDayInto.getDate() + 5);
          var take_4 = new Date(take_4);
          var fm_take_4 = `${take_4.getFullYear()}/${take_4.getMonth()+1}/${take_4.getDate()}`.replace(/\n|\r/g, '');

          var take_5 = dtDayInto.setDate(dtDayInto.getDate() + 8);
          var take_5 = new Date(take_5);
          var fm_take_5 = `${take_5.getFullYear()}/${take_5.getMonth()+1}/${take_5.getDate()}`.replace(/\n|\r/g, '');

          $("#take_1").val(fm_take_1);
          $("#take_2").val(fm_take_2);
          $("#take_3").val(fm_take_3);
          $("#take_4").val(fm_take_4);
          $("#take_5").val(fm_take_5);

      } else if(type == 3) {

          var type_3_text = $("#type_3").val();
          $("#type").val(type_3_text);
          var take_4 = dtDayInto.setDate(dtDayInto.getDate() + 4);
          var take_4 = new Date(take_4);
          var fm_take_4 = `${take_4.getFullYear()}/${take_4.getMonth()+1}/${take_4.getDate()}`.replace(/\n|\r/g, '');

          var take_5 = dtDayInto.setDate(dtDayInto.getDate() + 7);
          var take_5 = new Date(take_5);
          var fm_take_5 = `${take_5.getFullYear()}/${take_5.getMonth()+1}/${take_5.getDate()}`.replace(/\n|\r/g, '');

          $("#take_1").val(fm_take_1);
          $("#take_2").val(fm_take_2);
          $("#take_3").val(fm_take_3);
          $("#take_4").val(fm_take_4);
          $("#take_5").val(fm_take_5);

      } else {
          var type_4_text = $("#type_4").val();
          $("#type").val(type_4_text);
          var take_4 = dtDayInto.setDate(dtDayInto.getDate() + 5);
          var take_4 = new Date(take_4);
          var fm_take_4 = `${take_4.getFullYear()}/${take_4.getMonth()+1}/${take_4.getDate()}`.replace(/\n|\r/g, '');

          var take_5 = dtDayInto.setDate(dtDayInto.getDate() + 8);
          var take_5 = new Date(take_5);
          var fm_take_5 = `${take_5.getFullYear()}/${take_5.getMonth()+1}/${take_5.getDate()}`.replace(/\n|\r/g, '');

          $("#take_1").val(fm_take_1);
          $("#take_2").val(fm_take_2);
          $("#take_3").val(fm_take_3);
          $("#take_4").val(fm_take_4);
          $("#take_5").val(fm_take_5);

      }
}