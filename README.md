# Simple class for Zyte that does not require Guzzle, axios, or any other libraries or dependencies

# Include the class
include ('class.zyte.php');

# Initialize the ZyteExtractor with your API key
$extractor = new ZyteExtractor('asdf');

# Get raw HTML
$rawHtml = $extractor->getRawHTML('https://infinus.ca');

# Get screenshot
$screenshot = $extractor->getScreenshot('https://infinus.ca');

# Get rendered HTML
$renderedHtml = $extractor->getRenderedHTML('https://infinus.ca');

# Use the data as needed

# For example, to save the screenshot:
file_put_contents('screenshot.png', $screenshot); //approx cost .0078

# Raw HTML, pre-rendered (view source)
file_put_contents('rawhtml.txt', $rawHtml); //approx cost .0006

# Rendered HTML (headless browser)
file_put_contents('renderedhtml.txt', $renderedHtml); //approx cost .0058