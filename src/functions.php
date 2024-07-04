<?php

# ████████████████████████████████
# ██ Functions                  ██
# ████████████████████████████████

/**
 * Sanitizes text to be used inside HTML
 * 
 * @param string html
 *  Text to be sanitized
 */
function cleanHTML(
  string $html
) {
  return htmlspecialchars($html);
}