
$("#regist").on("submit", function(e){

    e.preventDefault();

    const name       = $("#name").val();
    const account    = $("#account").val();
    const grade      = $("#grade").val();
    const group      = $("#group").val();
    const photo      = $("#file").val();
    const turn       = $("#turn").val();
    const reason     = $("#reason").val();
    const college    = $("#college").val();
    const subject    = $("#subject").val();
    const profesor   = $("#profesor").val();
    const street     = $("#street").val();
    const colony     = $("#colony").val();
    const delegation = $("#delegation").val();
    const postalCode = $("#postalCode").val();
    const city       = $("#city").val();
    const tutor      = $("#tutor").val();
    const mobil      = $("#mobil").val();
    const phone      = $("#phone").val();
    const email      = $("#email").val();

    const data = [
      name, accout, grade, group, photo, turn, reason, college, subject, profesor, street,
      colony, delegation, postalCode, city, tutor, mobil, phone, email
    ];

    let fail;

    const validate = data.some( d => {
        const result = simpleFilter(d);
        if(!result) fail = result;
        return result;
    });

    if(!validate){
      const fail = data.find( d => {
        return simpleFilter(d);
      });
      fail.focus();
    }

    console.log(name, account, grade, group, photo, turn, reason, college, subject, profesor, street, colony, delegation, postalCode, city, tutor, mobil, phone, email);
    return false;
});