---
title: 'Contact us'
routable: false
cache_enable: false
form:
    name: contact-form
    template: form-messages
    action: /
    classes: 'row gtr-50 gtr-uniform'
    refresh_prevention: true
    fields:
        -
            name: Name
            label: false
            placeholder: Name
            validate:
                required: true
                message: 'Name is required'
            autofocus: 'off'
            autocomplete: 'on'
            type: text
            outerclasses: 'col-6 col-12-small'
            classes: null
        -
            name: Email
            label: false
            placeholder: Email
            validate:
                required: true
                message: 'Email is required'
            type: email
            outerclasses: 'col-6 col-12-small'
            classes: null
        -
            name: Subject
            label: false
            type: text
            placeholder: Subject
            validate:
                required: true
                message: 'Subject is required'
            outerclasses: 'col-12 col-12-small'
            classes: null
        -
            name: Message
            label: false
            placeholder: Message
            validate:
                required: true
                message: 'Message is required'
            type: textarea
            outerclasses: 'col-12 col-12-small'
            classes: null
            rows: 10
        -
            name: Privacy
            type: privacy
            label: 'Privacy Policy'
            validate:
                required: true
                message: 'By using this form you agree with our Privacy Policy'
    buttons:
        -
            type: submit
            value: Send
            outerclasses: form-field
            classes: 'button primary'
    process:
        save:
            fileprefix: contact-
            dateformat: dmY-His-u
            extension: txt
            body: '{% include ''forms/data.txt.twig'' %}'
        email:
            subject: '[Form from Editorial Website] {{ form.value.name|e }}'
            body: '{% include ''forms/data.html.twig'' %}'
        message: 'Thank you from your submission !'
        display: /thankyou
        reset: true
---

<h3>Send us your comments</h3>