# Script to Video Generator - Laravel Implementation

This Laravel application converts text scripts into videos using AI services. The workflow processes scripts through multiple AI-powered steps to generate images and videos.

## 🚀 Features

- **Script Processing**: Split scripts into sentences using OpenAI
- **AI-Powered Shotlists**: Generate detailed shotlists for each sentence
- **Rich Prompts**: Enhance shotlists into image and video prompts
- **Media Generation**: Create images using Seedream API and videos using Seedance API
- **Async Processing**: Queue-based job system for scalable processing
- **Progress Tracking**: Real-time status updates and progress monitoring
- **User Management**: Secure user authentication and script ownership

## 🏗️ Architecture

### Database Schema

#### Scripts Table
- `id`: Primary key
- `user_id`: Foreign key to users table
- `content`: Original script text
- `status`: pending, processing, completed, failed
- `metadata`: JSON field for additional data
- `timestamps`: created_at, updated_at

#### Sentences Table
- `id`: Primary key
- `script_id`: Foreign key to scripts table
- `original_sentence`: The sentence text
- `shotlist`: AI-generated shotlist
- `image_prompt`: Enhanced image prompt
- `video_prompt`: Enhanced video prompt
- `order_index`: Sentence position in script
- `status`: pending, processing, completed, failed
- `timestamps`: created_at, updated_at

#### Assets Table
- `id`: Primary key
- `sentence_id`: Foreign key to sentences table
- `type`: image or video
- `url`: Generated media URL
- `filename`: Optional filename
- `metadata`: JSON field for API response data
- `status`: pending, processing, completed, failed
- `timestamps`: created_at, updated_at

### Service Classes

#### OpenAIService
- `splitIntoSentences()`: Split script into individual sentences
- `generateShotlist()`: Create detailed shotlists for sentences
- `enhanceToImagePrompt()`: Convert shotlists to image prompts
- `enhanceToVideoPrompt()`: Convert shotlists to video prompts

#### SeedreamService
- `generateImage()`: Generate images from prompts
- `checkImageStatus()`: Check image generation status

#### SeedanceService
- `generateVideo()`: Generate videos from prompts
- `checkVideoStatus()`: Check video generation status

### Job Classes

#### ProcessScriptJob
- Splits script into sentences
- Creates sentence records
- Dispatches shotlist generation jobs

#### GenerateShotlistJob
- Generates shotlists for individual sentences
- Dispatches prompt enhancement jobs

#### EnhancePromptsJob
- Creates image and video prompts
- Dispatches media generation jobs

#### GenerateMediaJob
- Generates images and videos
- Updates script completion status

## 🔧 Setup Instructions

### 1. Environment Configuration

Add the following to your `.env` file:

```env
# OpenAI Configuration
OPENAI_API_KEY=your_openai_api_key_here
OPENAI_BASE_URL=https://api.openai.com/v1

# Seedream Configuration (for image generation)
SEEDREAM_API_KEY=your_seedream_api_key_here
SEEDREAM_BASE_URL=https://api.seedream.ai/v1

# Seedance Configuration (for video generation)
SEEDANCE_API_KEY=your_seedance_api_key_here
SEEDANCE_BASE_URL=https://api.seedance.ai/v1
```

### 2. Database Setup

```bash
# Run migrations
php artisan migrate

# Optional: Seed database with sample data
php artisan db:seed
```

### 3. Queue Configuration

Configure your queue driver in `.env`:

```env
QUEUE_CONNECTION=database
# or
QUEUE_CONNECTION=redis
```

Start the queue worker:

```bash
php artisan queue:work
```

### 4. Storage Configuration

Ensure your storage is properly configured for file uploads and generated assets.

## 🎯 Usage

### 1. Access the Application

Visit `/script-processor` to access the main interface.

### 2. Submit a Script

1. Paste your script into the textarea
2. Click "Generate Video"
3. The system will process your script asynchronously

### 3. Monitor Progress

- View real-time status updates
- Check individual sentence processing
- Monitor generated assets

### 4. View Results

- Browse all your scripts at `/scripts`
- View detailed results for each script
- Download or share generated media

## 🔄 Workflow Process

1. **Script Submission**: User submits script via Livewire form
2. **Script Processing**: `ProcessScriptJob` splits script into sentences
3. **Shotlist Generation**: `GenerateShotlistJob` creates shotlists for each sentence
4. **Prompt Enhancement**: `EnhancePromptsJob` generates image and video prompts
5. **Media Generation**: `GenerateMediaJob` creates images and videos
6. **Completion**: Script status updated to completed

## 🛠️ API Integration

### OpenAI Integration
- Uses GPT-4 for text processing
- Handles sentence splitting, shotlist generation, and prompt enhancement
- Configurable model parameters and temperature

### Seedream Integration
- Image generation using Stable Diffusion XL
- Configurable image size and quality
- Async status checking

### Seedance Integration
- Video generation using Runway Gen3
- Configurable duration and quality
- Image reference support

## 🔒 Security Features

- User authentication required
- Script ownership validation
- API key security
- Input validation and sanitization

## 📊 Monitoring and Logging

- Comprehensive logging for all API calls
- Error tracking and debugging
- Performance monitoring
- Queue status monitoring

## 🚀 Deployment Considerations

### Production Setup
1. Configure proper queue drivers (Redis recommended)
2. Set up monitoring for queue workers
3. Configure API rate limiting
4. Set up proper error handling and alerting
5. Configure backup strategies for generated assets

### Scaling
- Use Redis for queue management
- Implement horizontal scaling for queue workers
- Consider CDN for asset delivery
- Implement caching for frequently accessed data

## 🧪 Testing

```bash
# Run tests
php artisan test

# Run specific test suites
php artisan test --filter=ScriptProcessingTest
```

## 📝 API Documentation

### Script Management
- `GET /scripts` - List user scripts
- `GET /scripts/{id}` - View script details
- `DELETE /scripts/{id}` - Delete script
- `GET /scripts/{id}/status` - Get script status (JSON)

### Script Processing
- `GET /script-processor` - Main processing interface
- Real-time status updates via Livewire

## 🔧 Troubleshooting

### Common Issues

1. **Queue Jobs Not Processing**
   - Ensure queue worker is running
   - Check queue configuration
   - Verify database connection

2. **API Integration Issues**
   - Verify API keys are correct
   - Check API rate limits
   - Review error logs

3. **Asset Generation Failures**
   - Check API service status
   - Verify prompt quality
   - Review error messages

### Debug Commands

```bash
# Check queue status
php artisan queue:monitor

# View failed jobs
php artisan queue:failed

# Retry failed jobs
php artisan queue:retry all

# Clear failed jobs
php artisan queue:flush
```

## 📈 Performance Optimization

- Use Redis for queue management
- Implement caching for API responses
- Optimize database queries
- Use CDN for asset delivery
- Implement rate limiting

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Add tests
5. Submit a pull request

## 📄 License

This project is licensed under the MIT License.

## 🆘 Support

For support and questions:
- Check the troubleshooting section
- Review the logs
- Create an issue in the repository
- Contact the development team

---

**Note**: This implementation provides a solid foundation for script-to-video generation. Customize the AI prompts, API integrations, and UI components based on your specific requirements.
