export default { 
    groups: [
        {
            legend: "Languages",
            fields: [
                {
                    type: "language",
                    label: "Language A",
                    model: "side_1_language_code",
                    required: true,
                    default: "en-US",
                },
                {
                    type: "language",
                    label: "to Language B",
                    model: "side_2_language_code",
                    required: true,
                    default: "ru-RU",
                }
            ],
        },
        {

            legend: "Content",
            fields: [
                {
                    type: "textArea",
                    label: "Side A",
                    model: "side_1",
                    required: true,
                    rows: 4,
                },
                {
                    type: "textArea",
                    label: "Instructions B->A",
                    model: "side_1_instructions",
                    placeholder: 'Leave blank for default',
                    required: false,
                    rows: 1,
                },
                {
                    type: "textArea",
                    label: "Side B",
                    model: "side_2",
                    required: true,
                    rows: 2,
                    buttons: [{
                        classes: 'btn -btn-outline-secondary',
                        label: 'Autofill',
                        onclick: function(model,field) {
                            this.$parent.$parent.autofill();
                        }
                    }]
                },
                {
                    type: "textArea",
                    label: "Instructions A->B",
                    model: "side_2_instructions",
                    placeholder: 'Leave blank for default',
                    required: false,
                    rows: 1,
                },
            ]
        },
        {
            legend: "Meta",
            fields: [
                {
                    type: 'checkbox',
                    label: 'Reversable',
                    model: 'is_reversable',
                    default: true,
                },
                {
                    type: 'difficulty-level',
                    label: 'Difficulty',
                    model: 'difficulty_level_id'
                },
                {
                    type: 'category',
                    label: 'Category',
                    model: 'category_id'
                }
            ]

        }
    ]
}