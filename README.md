# DegreePlanner [![Project Status](https://img.shields.io/badge/Project%20Status-Kanban%20Board-brightgreen.svg?style=social)](http://jager-kujawa.com/gh-board/#/r/Kujawadl:DegreePlanner)

<!-- Badges for eventual gh-pages branch
[![GitHub issues](https://img.shields.io/github/issues/Kujawadl/DegreePlanner.svg?maxAge=2592000)]()
[![GitHub commits](https://img.shields.io/github/issues-pr/Kujawadl/DegreePlanner.svg?maxAge=2592000)]()
[![GitHub commits](https://img.shields.io/github/contributors/Kujawadl/DegreePlanner.svg?maxAge=2592000)]()
[![GitHub commits](https://img.shields.io/github/downloads/Kujawadl/DegreePlanner/total.svg?maxAge=2592000)]()
[![GitHub commits](https://img.shields.io/github/forks/Kujawadl/DegreePlanner.svg?maxAge=2592000)]()
[![GitHub commits](https://img.shields.io/github/stars/Kujawadl/DegreePlanner.svg?maxAge=2592000)]()
[![GitHub commits](https://img.shields.io/github/watchers/Kujawadl/DegreePlanner.svg?maxAge=2592000)]()
-->

This project hopes to simplify the process of creating a degree plan by managing degree requirements and course prerequisites. Users can select their primary and secondary majors, and a minor, and a custom report will be generated with a list of all required courses and their prerequisites, organized by which part of their degree requires it.

Degree requirements are organized in groups. A group has a specified minimum number of hours that must be completed in order for its demands to be considered satisfied. For example, at Stephen F. Austin State University, the Computer Science major requires 15 hours from CSC 102, 202, 211, 214, and 241 (i.e. all of those courses must be taken), while it only requires 6 hours from CSC 425, 435, 442, and 445 (i.e. students may choose two of the four courses).

In the earliest stages, this project has been implemented as a web application using PHP and MySQL. A vagrant file has been included to simplify the development process, though it does not yet include provisioning steps to configure the necessary database tables.

Eventually I would like to see about migrating to a desktop application. However, only a few hours has been spent so far on this, mainly just as a simple prototype. More information will be made available about the future of the project as I continue working on it.
