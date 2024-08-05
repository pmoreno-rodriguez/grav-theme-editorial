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
            id: name
            name: Name
            label: Name
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
            id: email
            name: Email
            label: Email
            autocomplete: 'on'
            placeholder: Email
            validate:
                required: true
                message: 'Email is required'
            type: email
            outerclasses: 'col-6 col-12-small'
            classes: null
        -
            id: subject
            name: Subject
            label: Subject
            type: text
            placeholder: Subject
            validate:
                required: true
                message: 'Subject is required'
            outerclasses: 'col-12 col-12-small'
            classes: null
        -
            id: message
            name: Message
            label: Message
            placeholder: Message
            validate:
                required: true
                message: 'Message is required'
            type: textarea
            outerclasses: 'col-12 col-12-small'
            classes: null
            rows: 10
        -
            id: privacy
            name: Privacy
            type: checkbox
            markdown: true
            label: 'By using this form you agree with our [Privacy Policy](/privacy)'
            validate:
                required: true
                message: 'Accept the privacy policy is required'
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
show_pageimage: true
image_width: 1000
image_height: 300
show_title: true
---

<h3>Send us your comments</h3>