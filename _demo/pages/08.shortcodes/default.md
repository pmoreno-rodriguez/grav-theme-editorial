---
title: Shortcodes
show_pageimage: false
image_width: 1000
image_height: 300
media_order: home.jpg
process:
    markdown: true
    twig: false
subtitle: 'Editorial shortcodes'
---

## Table Shortcode

### Usage

It's quite simple. Just wrap a markdown table in [raw]`[ed-table]`[/raw] tags.  The [raw]`[ed-table]`[/raw] shortcode has some optional parameters:

* `class` - alt (this class is provided by Editorial theme)
* `header` - true-<thead> is displayed. 
    
An example of the Table shortcode is as follows:
    
[raw]
```markdown
[ed-table header=true class="alt"]
| Header 1 | Header 2 |  Header 3 |  Header 4 |
| Cell 1   | Cell 2   | Cell 3   | Cell 4  |
| Cell 5   | Cell 6   | Cell 7   | Cell 8  |
[/ed-table]
```
[/raw]

#### Example
    
[ed-table header=true class="alt"]
| Header 1 | Header 2 |  Header 3 |  Header 4 |
| Cell 1   | Cell 2   | Cell 3   | Cell 4  |
| Cell 5   | Cell 6   | Cell 7   | Cell 8  |
[/ed-table]

## Box Shortcode

### Usage

Wrap some content block in [raw]`[ed-box]`[/raw] tags.  The [raw]`[ed-box]`[/raw] shortcode has some optional parameters:
    
* `heading` - The heading for box
* `color` - `primary`, `secondary`, `success`, `warning` and `info`. 
* `class` - `alt` (this class remove border from box). 

An example of the Box shortcode is as follows:
    
[raw]
```markdown
[ed-box color="primary" heading="Primary Box Shortcode"]
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sed eleifend magna, non tempor urna. 
[/ed-box]
[ed-box color="secondary" heading="Secondary Box Shortcode"]
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sed eleifend magna, non tempor urna. 
[/ed-box]
[ed-box color="success" heading="Success Box Shortcode"]
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sed eleifend magna, non tempor urna. 
[/ed-box]
[ed-box color="info" heading="Info Box Shortcode"]
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sed eleifend magna, non tempor urna. 
[/ed-box]
[ed-box color="warning" heading="Warning Box Shortcode"]
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sed eleifend magna, non tempor urna. 
[/ed-box]
[ed-box color="danger" heading="Danger Box Shortcode"]
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sed eleifend magna, non tempor urna. 
[/ed-box]
```
[/raw]

#### Example
    
[ed-box color="primary" heading="Primary Box Shortcode"]
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sed eleifend magna, non tempor urna. 
[/ed-box]
[ed-box color="secondary" heading="Secondary Box Shortcode"]
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sed eleifend magna, non tempor urna. 
[/ed-box]
[ed-box color="success" heading="Success Box Shortcode"]
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sed eleifend magna, non tempor urna. 
[/ed-box]
[ed-box color="info" heading="Info Box Shortcode"]
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sed eleifend magna, non tempor urna. 
[/ed-box]
[ed-box color="warning" heading="Warning Box Shortcode"]
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sed eleifend magna, non tempor urna. 
[/ed-box]
[ed-box color="danger" heading="Danger Box Shortcode"]
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sed eleifend magna, non tempor urna. 
[/ed-box]

## Buttons Shortcode
    
### Usage

Wrap some buttons in [raw]`[ed-buttons]`[/raw] tags.  The [raw]`[ed-buttons]`[/raw] has the parameter `ulclass` with the following values:  `stacked`, `special` or`fit`
    
The `[ed-button]` shortcode that defines each _button_ has the following parameters:
    
* `class`- custom classes for button
* `type` - `primary`, `secondary`, `success`, `info`, `warning` or `danger`. 
* `size` - `small`, `medium`or `large`
* `url`- The button url
* `target`- The target of url

An example of the Buttons shortcode is as follows:

[raw]
```markdown
[ed-buttons]
    [ed-button type="primary"  url="#"]Primary[/ed-button]
    [ed-button type="secondary" url="#"]Secondary[/ed-button]
    [ed-button type="success" url="#"]Success[/ed-button]
    [ed-button type="info" url="#"]Info[/ed-button]
    [ed-button type="warning" url="#"]Warning[/ed-button]
    [ed-button type="danger" url="#"]Danger[/ed-button]
[/ed-buttons]
[ed-buttons]
    [ed-button type="primary" size="small"  url="#"]Primary[/ed-button]
    [ed-button type="secondary" size="small"   url="#"]Secondary[/ed-button]
    [ed-button type="success" size="small"   url="#"]Success[/ed-button]
    [ed-button type="info" size="small" url="#"]Info[/ed-button]
    [ed-button type="warning" size="small" url="#"]Warning[/ed-button]
    [ed-button type="danger" size="small" url="#"]Danger[/ed-button]
[/ed-buttons]
[ed-buttons ulclass="special"]
    [ed-button type="primary" size="small"  url="#"]Primary[/ed-button]
    [ed-button type="secondary" size="small"   url="#"]Secondary[/ed-button]
[/ed-buttons]
[ed-buttons ulclass="stacked"]
    [ed-button type="primary" size="small"  url="#"]Primary[/ed-button]
    [ed-button type="secondary" size="small"   url="#"]Secondary[/ed-button]
[/ed-buttons]
[ed-buttons ulclass="fit"]
    [ed-button type="primary" size="small"  url="#"]Primary[/ed-button]
    [ed-button type="secondary" size="small"   url="#"]Secondary[/ed-button]
[/ed-buttons]
```
[/raw]

#### Example
    
[ed-buttons]
    [ed-button type="primary"  url="#"]Primary[/ed-button]
    [ed-button type="secondary" url="#"]Secondary[/ed-button]
    [ed-button type="success" url="#"]Success[/ed-button]
    [ed-button type="info" url="#"]Info[/ed-button]
    [ed-button type="warning" url="#"]Warning[/ed-button]
    [ed-button type="danger" url="#"]Danger[/ed-button]
[/ed-buttons]
[ed-buttons]
    [ed-button type="primary" size="small"  url="#"]Primary[/ed-button]
    [ed-button type="secondary" size="small"   url="#"]Secondary[/ed-button]
    [ed-button type="success" size="small"   url="#"]Success[/ed-button]
    [ed-button type="info" size="small" url="#"]Info[/ed-button]
    [ed-button type="warning" size="small" url="#"]Warning[/ed-button]
    [ed-button type="danger" size="small" url="#"]Danger[/ed-button]
[/ed-buttons]
[ed-buttons ulclass="special"]
    [ed-button type="primary" size="small"  url="#"]Primary[/ed-button]
    [ed-button type="secondary" size="small"   url="#"]Secondary[/ed-button]
[/ed-buttons]
[ed-buttons ulclass="stacked"]
    [ed-button type="primary" size="small"  url="#"]Primary[/ed-button]
    [ed-button type="secondary" size="small"   url="#"]Secondary[/ed-button]
[/ed-buttons]
[ed-buttons ulclass="fit"]
    [ed-button type="primary disable" size="small"  url="#"]Primary[/ed-button]
    [ed-button type="secondary" size="small"   url="#"]Secondary[/ed-button]
[/ed-buttons]

## Flex row Shortcode
    
### Usage

Use the [raw]`[ed-flex-row]`[/raw] shortcode to set the number of columns that best render your content and layout. The [raw]`[ed-flex-row]`[/raw] has the following parameters: 
    * `class`- Row classes from Editorial theme (space separated): `gtr-uniform`, `gtr-0`, `gtr-25`, `gtr-50`, `gtr-150`, `gtr-200`, `aln-between`, `aln-around`, `aln-evenly`, `aln-left`, `aln-center`, `aln-right`, `aln-top`, `aln-bottom` and `aln-middle` . 
    
The [raw]`[column]`[/raw] shortcode that defines each to the individual columns (e.g., .col-4 col-12-medium),  has the following parameters:
    
* `class`- Column classes  from Editorial theme (space separated), indicate the number of columns you’d like to use out of the possible 12 per row. So, if you want three equal-width columns across, you can use col-4. To make the grid responsive, there are five grid breakpoints, one for each responsive breakpoint : `xsmall`, `small`, `medium`, `large` and `xlarge`.

An example of the Flex row shortcode is as follows:
    
[raw]
```markdown
[ed-flex-row class="gtr-50"]
[column class="col-4 col-12-medium"]
[ed-box color="primary" heading="Primary"]
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sed eleifend magna, non tempor urna. Integer maximus, velit non scelerisque ornare, ante libero porta lorem, ac eleifend felis sapien eu leo. Fusce mauris justo, ullamcorper ut urna a, scelerisque viverra magna.
[/ed-box]
[/column]
    
[column class="col-4 col-12-medium"]
[ed-box color="secondary" heading="Secondary"]
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sed eleifend magna, non tempor urna. Integer maximus, velit non scelerisque ornare, ante libero porta lorem, ac eleifend felis sapien eu leo. Fusce mauris justo, ullamcorper ut urna a, scelerisque viverra magna.
[/ed-box]
[/column]
    
[column class="col-4 col-12-medium"]
[ed-box color="success" heading="Success"]
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sed eleifend magna, non tempor urna. Integer maximus, velit non scelerisque ornare, ante libero porta lorem, ac eleifend felis sapien eu leo. Fusce mauris justo, ullamcorper ut urna a, scelerisque viverra magna.
[/ed-box]
[/column]
    
[column class="col-4 col-12-medium"]
[ed-buttons]
    [ed-button type="primary"  url="#"]Primary[/ed-button]
    [ed-button type="secondary" url="#"]Secondary[/ed-button]
    [ed-button type="success" url="#"]Success[/ed-button]
    [ed-button type="info" url="#"]Info[/ed-button]
    [ed-button type="warning" url="#"]Warning[/ed-button]
    [ed-button type="danger" url="#"]Danger[/ed-button]
[/ed-buttons]
[/column]
    
[column class="col-4 col-12-medium"]
[ed-table header=true class="alt"]
| Header 1 | Header 2 |  Header 3 |  Header 4 |
| Cell 1   | Cell 2   | Cell 3   | Cell 4  |
| Cell 5   | Cell 6   | Cell 7   | Cell 8  |
[/ed-table]
[/column]
    
[column class="col-4 col-12-medium"]
> Blockquote text
 
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sed eleifend magna, non tempor urna. Integer maximus, velit non scelerisque ornare, ante libero porta lorem, ac eleifend felis sapien eu leo.
[/column]
    
[/ed-flex-row]
```
[/raw]

#### Example
    
[ed-flex-row class="gtr-50"]
[column class="col-4 col-12-medium"]
[ed-box color="primary" heading="Primary"]
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sed eleifend magna, non tempor urna. Integer maximus, velit non scelerisque ornare, ante libero porta lorem, ac eleifend felis sapien eu leo. Fusce mauris justo, ullamcorper ut urna a, scelerisque viverra magna.
[/ed-box]
[/column]
    
[column class="col-4 col-12-medium"]
[ed-box color="secondary" heading="Secondary"]
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sed eleifend magna, non tempor urna. Integer maximus, velit non scelerisque ornare, ante libero porta lorem, ac eleifend felis sapien eu leo. Fusce mauris justo, ullamcorper ut urna a, scelerisque viverra magna.
[/ed-box]
[/column]
    
[column class="col-4 col-12-medium"]
[ed-box color="success" heading="Success"]
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sed eleifend magna, non tempor urna. Integer maximus, velit non scelerisque ornare, ante libero porta lorem, ac eleifend felis sapien eu leo. Fusce mauris justo, ullamcorper ut urna a, scelerisque viverra magna.
[/ed-box]
[/column]
    
[column class="col-4 col-12-medium"]
[ed-buttons]
    [ed-button type="primary"  url="#"]Primary[/ed-button]
    [ed-button type="secondary" url="#"]Secondary[/ed-button]
    [ed-button type="success" url="#"]Success[/ed-button]
    [ed-button type="info" url="#"]Info[/ed-button]
    [ed-button type="warning" url="#"]Warning[/ed-button]
    [ed-button type="danger" url="#"]Danger[/ed-button]
[/ed-buttons]
[/column]
    
[column class="col-4 col-12-medium"]
[ed-table header=true class="alt"]
| Header 1 | Header 2 |  Header 3 |  Header 4 |
| Cell 1   | Cell 2   | Cell 3   | Cell 4  |
| Cell 5   | Cell 6   | Cell 7   | Cell 8  |
[/ed-table]
[/column]
    
[column class="col-4 col-12-medium"]
> Blockquote text
 
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sed eleifend magna, non tempor urna. Integer maximus, velit non scelerisque ornare, ante libero porta lorem, ac eleifend felis sapien eu leo.
[/column]
    
[/ed-flex-row]

## Float image Shortcode

### Usage

Use the [raw]`[ed-float]`[/raw] shortcode to display a floating image, to the left or right of a text.
    
The [raw]`[ed-float]`[/raw] shortcode has the following parameters:
    
	* `direction` - left or right
    * `image` - Image name from page media
    * `alt` - Alt tag for image
    * `title` - Image title

An example of the Float image shortcode is as follows:
    
[raw]
```markdown
[ed-float direction=left image="home.jpg" alt="Home" title="Home"]
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sed eleifend magna, non tempor urna. Integer maximus, velit non scelerisque ornare, ante libero porta lorem, ac eleifend felis sapien eu leo. Fusce mauris justo, ullamcorper ut urna a, scelerisque viverra magna. Pellentesque eu lectus dignissim justo consectetur tristique.
[/ed-float]
[ed-float direction=right image="home.jpg" alt="Home" title="Home"]
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sed eleifend magna, non tempor urna. Integer maximus, velit non scelerisque ornare, ante libero porta lorem, ac eleifend felis sapien eu leo. Fusce mauris justo, ullamcorper ut urna a, scelerisque viverra magna. Pellentesque eu lectus dignissim justo consectetur tristique.
[/ed-float]
```
[/raw]

#### Example

[ed-float direction=left image="home.jpg" alt="Home" title="Home"]
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sed eleifend magna, non tempor urna. Integer maximus, velit non scelerisque ornare, ante libero porta lorem, ac eleifend felis sapien eu leo. Fusce mauris justo, ullamcorper ut urna a, scelerisque viverra magna. Pellentesque eu lectus dignissim justo consectetur tristique.
[/ed-float]
[ed-float direction=right image="home.jpg" alt="Home" title="Home"]
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sed eleifend magna, non tempor urna. Integer maximus, velit non scelerisque ornare, ante libero porta lorem, ac eleifend felis sapien eu leo. Fusce mauris justo, ullamcorper ut urna a, scelerisque viverra magna. Pellentesque eu lectus dignissim justo consectetur tristique.
[/ed-float]