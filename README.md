# Basis Data Export [![Build Status](https://travis-ci.org/troussos/basis-data-export.png?branch=master)](https://travis-ci.org/troussos/basis-data-export)  [![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/troussos/basis-data-export/badges/quality-score.png?s=adc3d0323901897db37db9fbf03b63785a19182d)](https://scrutinizer-ci.com/g/troussos/basis-data-export/)   [![Code Coverage](https://scrutinizer-ci.com/g/troussos/basis-data-export/badges/coverage.png?s=f7bb9b66148f6a2f26479e4a5850515ce24425ec)](https://scrutinizer-ci.com/g/troussos/basis-data-export/)

Utility that exports and saves your Basis B1 device's uploaded sensor data.
You can learn more about Basis at [http://www.mybasis.com/](http://www.mybasis.com/)

This project is a fork of [basis-data-export](https://github.com/btroia/basis-data-export).

Much of the documentation on how to use the library comes in the form of PHPDoc comments and through the demo app. To test out pulling data with the demo app, subsitute your My Basis ID for the '1' that can be found on line 10. From there, you can dump out the $parsedData variable or use it for other data processing. This should give a loose idea as to how the library works and how to use it.

## Instructions

### Finding Your Basis User ID
- Log into your Basis account at [http://www.mybasis.com](http://gist.github.com).
- Right-click and access your web browser's developer tools by selecting "Inspect Element" (on Chrome - you can also access this by going to the "View->Developer->Developer Tools" menu):

![basis export step 1](http://www.quantifiedbob.com/2013/basis-screenshots/export1.png)

- You should now see the Developer Tools pane:

![basis export step 2](http://www.quantifiedbob.com/2013/basis-screenshots/export2.png)

- Go to the "Data" menu and select "Details":

![basis export step 3](http://www.quantifiedbob.com/2013/basis-screenshots/export3.png)

- Click on the "Network" tab in the Developer Tools frame and reload the page:

![basis export step 4](http://www.quantifiedbob.com/2013/basis-screenshots/export4.png)

Scroll down the list of network requests and look for a request that beings with:
"https://app.mybasis.com/api/v1/chart/123a4567b89012345678d9e.json?summary=true..."

The letters after "...chart/" and preceding ".json?..." are your Basis user id! Note this string.

## Data Values

Basis currently returns the following data points. They will represent an average (for heart rate) or sum (steps) over the previous 1-minute period:

- Time - time reading was taken
- Heart Rate - beats per minute
- Steps - number of steps taken
- Calories - number of calories burned
- GSR - Galvanic skin response (i.e., sweat/skin conductivity. Learn more about GSR here - [http://en.wikipedia.org/wiki/Skin_conductance](http://en.wikipedia.org/wiki/Skin_conductance)
- Skin Temperature - skin temperature (degrees F)
- Air Temperature - air temperatute (degrees F)

There are some other aggregate metrics included in the reponse such as min/max/average/standard deviation metrics for each set of data.
