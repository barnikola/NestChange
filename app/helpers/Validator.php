<?php

class Validator
{
    private array $errors = [];
    private array $data = [];

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    /**
     * Validate required field
     */
    public function required(string $field, string $message = ''): self
    {
        $value = $this->getValue($field);
        
        if ($value === null || $value === '' || (is_array($value) && empty($value))) {
            $this->addError($field, $message ?: "{$field} is required.");
        }
        
        return $this;
    }

    /**
     * Validate email format
     */
    public function email(string $field, string $message = ''): self
    {
        $value = $this->getValue($field);
        
        if ($value && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->addError($field, $message ?: "Please enter a valid email address.");
        }
        
        return $this;
    }

    /**
     * Validate minimum length
     */
    public function minLength(string $field, int $min, string $message = ''): self
    {
        $value = $this->getValue($field);
        
        if ($value && strlen($value) < $min) {
            $this->addError($field, $message ?: "{$field} must be at least {$min} characters.");
        }
        
        return $this;
    }

    /**
     * Validate maximum length
     */
    public function maxLength(string $field, int $max, string $message = ''): self
    {
        $value = $this->getValue($field);
        
        if ($value && strlen($value) > $max) {
            $this->addError($field, $message ?: "{$field} must be no more than {$max} characters.");
        }
        
        return $this;
    }

    /**
     * Validate exact length
     */
    public function length(string $field, int $length, string $message = ''): self
    {
        $value = $this->getValue($field);
        
        if ($value && strlen($value) !== $length) {
            $this->addError($field, $message ?: "{$field} must be exactly {$length} characters.");
        }
        
        return $this;
    }

    /**
     * Validate password strength
     */
    public function password(string $field, string $message = ''): self
    {
        $value = $this->getValue($field);
        
        if ($value) {
            // At least 8 characters, 1 uppercase, 1 lowercase, 1 number
            $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/';
            
            if (!preg_match($pattern, $value)) {
                $this->addError($field, $message ?: "Password must be at least 8 characters with uppercase, lowercase, and a number.");
            }
        }
        
        return $this;
    }

    /**
     * Validate fields match (e.g., password confirmation)
     */
    public function matches(string $field, string $matchField, string $message = ''): self
    {
        $value = $this->getValue($field);
        $matchValue = $this->getValue($matchField);
        
        if ($value !== $matchValue) {
            $this->addError($field, $message ?: "{$field} does not match {$matchField}.");
        }
        
        return $this;
    }

    /**
     * Validate numeric value
     */
    public function numeric(string $field, string $message = ''): self
    {
        $value = $this->getValue($field);
        
        if ($value && !is_numeric($value)) {
            $this->addError($field, $message ?: "{$field} must be a number.");
        }
        
        return $this;
    }

    /**
     * Validate integer value
     */
    public function integer(string $field, string $message = ''): self
    {
        $value = $this->getValue($field);
        
        if ($value && !filter_var($value, FILTER_VALIDATE_INT)) {
            $this->addError($field, $message ?: "{$field} must be an integer.");
        }
        
        return $this;
    }

    /**
     * Validate minimum value
     */
    public function min(string $field, int|float $min, string $message = ''): self
    {
        $value = $this->getValue($field);
        
        if ($value !== null && $value !== '' && $value < $min) {
            $this->addError($field, $message ?: "{$field} must be at least {$min}.");
        }
        
        return $this;
    }

    /**
     * Validate maximum value
     */
    public function max(string $field, int|float $max, string $message = ''): self
    {
        $value = $this->getValue($field);
        
        if ($value !== null && $value !== '' && $value > $max) {
            $this->addError($field, $message ?: "{$field} must be no more than {$max}.");
        }
        
        return $this;
    }

    /**
     * Validate value is in array
     */
    public function in(string $field, array $values, string $message = ''): self
    {
        $value = $this->getValue($field);
        
        if ($value && !in_array($value, $values, true)) {
            $this->addError($field, $message ?: "{$field} is not a valid option.");
        }
        
        return $this;
    }

    /**
     * Validate URL format
     */
    public function url(string $field, string $message = ''): self
    {
        $value = $this->getValue($field);
        
        if ($value && !filter_var($value, FILTER_VALIDATE_URL)) {
            $this->addError($field, $message ?: "Please enter a valid URL.");
        }
        
        return $this;
    }

    /**
     * Validate date format
     */
    public function date(string $field, string $format = 'Y-m-d', string $message = ''): self
    {
        $value = $this->getValue($field);
        
        if ($value) {
            $date = \DateTime::createFromFormat($format, $value);
            if (!$date || $date->format($format) !== $value) {
                $this->addError($field, $message ?: "Please enter a valid date.");
            }
        }
        
        return $this;
    }

    /**
     * Validate phone number
     */
    public function phone(string $field, string $message = ''): self
    {
        $value = $this->getValue($field);
        
        if ($value) {
            // Remove common formatting characters
            $cleaned = preg_replace('/[\s\-\.\(\)]+/', '', $value);
            
            // Check if it's a reasonable phone number (7-15 digits, optional + prefix)
            if (!preg_match('/^\+?\d{7,15}$/', $cleaned)) {
                $this->addError($field, $message ?: "Please enter a valid phone number.");
            }
        }
        
        return $this;
    }

    /**
     * Validate with custom callback
     */
    public function custom(string $field, callable $callback, string $message = ''): self
    {
        $value = $this->getValue($field);
        
        if (!$callback($value, $this->data)) {
            $this->addError($field, $message ?: "{$field} is invalid.");
        }
        
        return $this;
    }

    /**
     * Validate file upload
     */
    public function file(string $field, array $options = [], string $message = ''): self
    {
        if (!isset($_FILES[$field])) {
             if (isset($options['required']) && $options['required']) {
                $this->addError($field, $message ?: "Please upload a file.");
            }
            return $this;
        }

        $fileData = $_FILES[$field];
        
        // Helper function to validate a single file
        $validateSingleFile = function($error, $size, $tmpName) use ($field, $message, $options) {
             if ($error === UPLOAD_ERR_NO_FILE) {
                if (isset($options['required']) && $options['required']) {
                     $this->addError($field, $message ?: "Please upload a file.");
                }
                return;
            }

            if ($error !== UPLOAD_ERR_OK) {
                $this->addError($field, "File upload failed.");
                return;
            }

            // Check file size
            if (isset($options['maxSize']) && $size > $options['maxSize']) {
                $maxMb = $options['maxSize'] / 1024 / 1024;
                $this->addError($field, $message ?: "File size must be less than {$maxMb}MB.");
            }

            // Check mime type
            if (isset($options['mimeTypes'])) {
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mimeType = finfo_file($finfo, $tmpName);
                finfo_close($finfo);
                
                if (!in_array($mimeType, $options['mimeTypes'])) {
                    $this->addError($field, $message ?: "Invalid file type.");
                }
            }
        };

        // Check if multiple files (array of names)
        if (is_array($fileData['name'])) {
            $count = count($fileData['name']);
            // Check if ANY file was uploaded if required
            $hasFile = false;
            for ($i = 0; $i < $count; $i++) {
                if ($fileData['error'][$i] !== UPLOAD_ERR_NO_FILE) {
                    $hasFile = true;
                    break;
                }
            }
            
            if (!$hasFile && isset($options['required']) && $options['required']) {
                 $this->addError($field, $message ?: "Please upload a file.");
                 return $this;
            }

            for ($i = 0; $i < $count; $i++) {
                // Skip empty slots if not required, but if required we checked hasFile above.
                // Actually if one file fails, we add error.
                if ($fileData['error'][$i] === UPLOAD_ERR_NO_FILE) continue;

                $validateSingleFile(
                    $fileData['error'][$i],
                    $fileData['size'][$i],
                    $fileData['tmp_name'][$i]
                );
            }
        } else {
            // Single file
            $validateSingleFile(
                $fileData['error'],
                $fileData['size'],
                $fileData['tmp_name']
            );
        }

        return $this;
    }

    /**
     * Add an error
     */
    public function addError(string $field, string $message): self
    {
        if (!isset($this->errors[$field])) {
            $this->errors[$field] = [];
        }
        $this->errors[$field][] = $message;
        return $this;
    }

    /**
     * Check if validation passed
     */
    public function passes(): bool
    {
        return empty($this->errors);
    }

    /**
     * Check if validation failed
     */
    public function fails(): bool
    {
        return !$this->passes();
    }

    /**
     * Get all errors
     */
    public function errors(): array
    {
        return $this->errors;
    }

    /**
     * Get first error for a field
     */
    public function error(string $field): ?string
    {
        return $this->errors[$field][0] ?? null;
    }

    /**
     * Get first error message
     */
    public function firstError(): ?string
    {
        foreach ($this->errors as $fieldErrors) {
            return $fieldErrors[0] ?? null;
        }
        return null;
    }

    /**
     * Get all error messages as flat array
     */
    public function allErrors(): array
    {
        $all = [];
        foreach ($this->errors as $fieldErrors) {
            $all = array_merge($all, $fieldErrors);
        }
        return $all;
    }

    /**
     * Get value from data
     */
    private function getValue(string $field): mixed
    {
        // Support dot notation for nested data
        $keys = explode('.', $field);
        $value = $this->data;
        
        foreach ($keys as $key) {
            if (!is_array($value) || !isset($value[$key])) {
                return null;
            }
            $value = $value[$key];
        }
        
        return $value;
    }

    /**
     * Static factory method
     */
    public static function make(array $data): self
    {
        return new self($data);
    }
}
