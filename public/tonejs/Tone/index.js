require("./component/AmplitudeEnvelope");
require("./component/Analyser");
require("./component/Channel");
require("./component/Compressor");
require("./component/CrossFade");
require("./component/Envelope");
require("./component/EQ3");
require("./component/FeedbackCombFilter");
require("./component/FFT");
require("./component/Filter");
require("./component/Follower");
require("./component/FrequencyEnvelope");
require("./component/Gate");
require("./component/LFO");
require("./component/Limiter");
require("./component/LowpassCombFilter");
require("./component/Merge");
require("./component/Meter");
require("./component/MidSideCompressor");
require("./component/MidSideMerge");
require("./component/MidSideSplit");
require("./component/Mono");
require("./component/MultibandCompressor");
require("./component/MultibandSplit");
require("./component/Panner");
require("./component/Panner3D");
require("./component/PanVol");
require("./component/ScaledEnvelope");
require("./component/Solo");
require("./component/Split");
require("./component/Volume");
require("./component/Waveform");
require("./control/CtrlInterpolate");
require("./control/CtrlMarkov");
require("./control/CtrlPattern");
require("./control/CtrlRandom");
require("./core/AudioNode");
require("./core/Buffer");
require("./core/Buffers");
require("./core/Bus");
require("./core/Clock");
require("./core/Context");
require("./core/Delay");
require("./core/Draw");
require("./core/Emitter");
require("./core/Gain");
require("./core/IntervalTimeline");
require("./core/Listener");
require("./core/Master");
require("./core/Offline");
require("./core/OfflineContext");
require("./core/Param");
require("./core/Timeline");
require("./core/TimelineState");
require("./core/Transport");
require("./core/TransportEvent");
require("./core/TransportRepeatEvent");
require("./effect/AutoFilter");
require("./effect/AutoPanner");
require("./effect/AutoWah");
require("./effect/BitCrusher");
require("./effect/Chebyshev");
require("./effect/Chorus");
require("./effect/Convolver");
require("./effect/Distortion");
require("./effect/Effect");
require("./effect/FeedbackDelay");
require("./effect/FeedbackEffect");
require("./effect/Freeverb");
require("./effect/JCReverb");
require("./effect/MidSideEffect");
require("./effect/Phaser");
require("./effect/PingPongDelay");
require("./effect/PitchShift");
require("./effect/Reverb");
require("./effect/StereoEffect");
require("./effect/StereoFeedbackEffect");
require("./effect/StereoWidener");
require("./effect/StereoXFeedbackEffect");
require("./effect/Tremolo");
require("./effect/Vibrato");
require("./event/Event");
require("./event/Loop");
require("./event/Part");
require("./event/Pattern");
require("./event/Sequence");
require("./instrument/AMSynth");
require("./instrument/DuoSynth");
require("./instrument/FMSynth");
require("./instrument/Instrument");
require("./instrument/MembraneSynth");
require("./instrument/MetalSynth");
require("./instrument/Monophonic");
require("./instrument/MonoSynth");
require("./instrument/NoiseSynth");
require("./instrument/PluckSynth");
require("./instrument/PolySynth");
require("./instrument/Sampler");
require("./instrument/Synth");
require("./signal/Abs");
require("./signal/Add");
require("./signal/AudioToGain");
require("./signal/EqualPowerGain");
require("./signal/GainToAudio");
require("./signal/GreaterThan");
require("./signal/GreaterThanZero");
require("./signal/Modulo");
require("./signal/Multiply");
require("./signal/Negate");
require("./signal/Normalize");
require("./signal/Pow");
require("./signal/Scale");
require("./signal/ScaleExp");
require("./signal/Signal");
require("./signal/SignalBase");
require("./signal/Subtract");
require("./signal/TickSignal");
require("./signal/TransportTimelineSignal");
require("./signal/WaveShaper");
require("./signal/Zero");
require("./source/AMOscillator");
require("./source/BufferSource");
require("./source/FatOscillator");
require("./source/FMOscillator");
require("./source/GrainPlayer");
require("./source/Noise");
require("./source/OmniOscillator");
require("./source/Oscillator");
require("./source/OscillatorNode");
require("./source/Player");
require("./source/Players");
require("./source/PulseOscillator");
require("./source/PWMOscillator");
require("./source/Source");
require("./source/TickSource");
require("./source/UserMedia");
require("./type/Frequency");
require("./type/Midi");
require("./type/Ticks");
require("./type/Time");
require("./type/TimeBase");
require("./type/TransportTime");
require("./type/Type");
module.exports = require("./core/Tone").default;
export declare function now(): import("Units").Seconds;
/**
 * The Transport object belonging to the global Tone.js Context
 * @Category Core
 */
