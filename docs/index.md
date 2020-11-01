<a href="https://photon-platform.net/">
    <img src="https://photon-platform.net/user/images/photon-logo-banner.png" alt="photon" title="photon" align="right" height="120" />
</a>


# photon ✴ Mermaid

## 1.0.3

---


> add Mermaid diagrams to photon - fork from grav-plugins-diagrams

- [configuration](#configuration)
- [templates](#templates)
- [scaffolds](#scaffolds)
- [scss](#scss)
- [assets](#assets)
- [languages](#languages)

# configuration
blueprints.yaml

fields:
- enabled

Before configuring this plugin, you should copy the `user/plugins/photon-mermaid/photon-mermaid.yaml` to `user/config/plugins/photon-mermaid.yaml` and only edit that copy.

Here is the default configuration and an explanation of available options:

```yaml
# General settings
# ****************

enabled: true	# Plugin activation
align: center	# Position of diagrams [left, center, right]

# Settings of sequence diagrams
# ****************

theme: simple # Diagrams' themes [simple, hand]

# Settings of flow diagrams
# ****************

font:
  size: 14		# General font size
  color: black	# General font color

line:
  color: black	# General color of lines

element:
  color: black	# General border color of elements

condition:
  yes: yes		# Default text for the arrows of positive condition
  no: no		# Default text for the arrows of negative condition

# Settings of mermaid
# ****************

gantt:
  axis: %d-%m-%Y # Default gantt diagram axis format (https://github.com/d3/d3-3.x-api-reference/blob/master/Time-Formatting.md)
```

Note that if you use the admin plugin, a file with your configuration, and named photon-mermaid.yaml will be saved in the `user/config/plugins/` folder once the configuration is saved in the admin.


# scss

```sh
scss
└── _diagrams.scss
```

# assets

```sh
assets
├── flow.png
├── mermaid_1.png
├── mermaid_2.png
└── sequence.png
```


## Installation

- all photon plugins are installed as git submodules. More on that later.



## Configuration


## Usage

Select template type when creating a new page

## Credits


## To Do

- [ ] Future plans, if any


copyright &copy; 2020
