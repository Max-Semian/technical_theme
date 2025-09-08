window.addEventListener("load", ()=>{
    let inputs = document.querySelectorAll('[type="number"][name*="operator_criteria"]')
    setTimeout(() => {
        if(inputs.length === 0){
            inputs = document.querySelectorAll('[name*="operator_criteria"]')
            setIventListeners(inputs)
        }
    }, 50);
    setIventListeners(inputs)
    

    function setIventListeners (inputs) {
        if(inputs.length === 0) return
        const fieldset = inputs[0].closest('fieldset')
        const total = document.querySelector('[name="carbon_fields_compact_input[_operator_criteria_total]"]')
        fieldset.addEventListener('input', e=>{
            total.value = countRating(inputs)
        })
    }

    function countRating (inputs){
        let ratings = []
        for(let input of inputs){
            let val = input.value
            if(!isNaN(val)){parseInt(input.value)}else{continue}
            if(input.name.includes('criteria_total')){continue} 
            input.name.includes('criteria_reliability') && (val *= .25)
            input.name.includes('criteria_bonuses') && (val *= .2)
            input.name.includes('criteria_payments') && (val *= .15)
            input.name.includes('criteria_games') && (val *= .15)
            input.name.includes('criteria_ui') && (val *= .15)
            input.name.includes('criteria_support') && (val *= .1)
            ratings.push(val)
        }
        return (ratings.reduce((acc, cur)=>acc+cur, 0)).toFixed(1)
    }
})