# Accessibility Audit Guide

## Executive Summary
This document summarizes the accessibility improvements made to the Auth and Profile views of NestChange.

## Audit Checklist

### Authentication Views (`signin.php`, `register.php`)
- [x] **Labels**: All form inputs have associated labels with correct `for` attributes matching input `id`s.
- [x] **Decorative Icons**: 
    - Google Sign-In SVG icon marked as `aria-hidden="true"` and `focusable="false"`.
    - File upload clip icons marked as `aria-hidden="true"`.
- [x] **Focus**: Inputs are reachable via keyboard navigation.

### Profile Views (`profile.php`, `edit_profile.php`)
- [x] **Images**:
    - Profile avatars include descriptive `alt` text (e.g., "User's Avatar").
    - Initials placeholder marked `aria-hidden="true"` to avoid screen readers announcing meaningless text.
- [x] **Structure**:
    - Headings used for sections ("Your Dashboard", "Account Settings").
- [x] **Forms**:
    - Edit profile form inputs have explicit labels.
    - File upload inputs are accessible.
    - Duplicate content in `edit_profile.php` was removed.

## Color Contrast
- The dark theme (`dark-page` class) was reviewed.
- Text on dark backgrounds appears to meet WCAG AA standards for contrast (white/light grey on dark grey).
- Status badges (Green/Yellow) use standard color coding which may need text supplement for color-blind users (already included as text "Approved"/"Pending").

## Keyboard Navigation
- Verified that all interactive elements (Links, Buttons, Inputs) are focusable and follow a logical tab order.
